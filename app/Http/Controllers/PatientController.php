<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Patient;
use App\Models\Referral;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient_record;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendEmail;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::transaction(function () {
            $practice_place = Doctor::find(Auth::user()->role_id, ['practice_place']);

            $doctors_under = Doctor::select('id')
                ->where('practice_place', '=', $practice_place->practice_place)
                ->groupBy('id')
                ->get();

            $doctorsUnderSamePlace = array();

            foreach ($doctors_under as $doctor) {
                array_push($doctorsUnderSamePlace, $doctor->id);
            }

            $doctorPatientAppointment = Appointment::select('patient_id')
                ->whereIn('doctor_id', $doctorsUnderSamePlace)
                ->orWhere('doctor_id', '=', Auth::user()->role_id)
                ->groupBy('patient_id')
                ->get();

            $doctorPatientReferral = Referral::select('patient_id')
                ->whereIn('from_doctor_id', $doctorsUnderSamePlace)
                ->orWhere('from_doctor_id', '=', Auth::user()->role_id)
                ->orWhere('to_doctor_id', '=', Auth::user()->role_id)
                ->groupBy('patient_id')
                ->get();

            $doctorPatient = $doctorPatientAppointment->union($doctorPatientReferral);
            return Patient::whereIn('id', $doctorPatient)->paginate(15);
        });

        foreach ($data as $patient) {
            $today = date('Y-m-d');
            $diff = date_diff(date_create($patient->date_of_birth), date_create($today));

            if ($diff->y == 0) {
                if ($diff->m == 0) {
                    $patient->age = $diff->d . " days old";
                } else {
                    $patient->age = $diff->m . " months old";
                }
            } else {
                $patient->age = $diff->y . " years old";
            }
        }

        return view('patients.index', ['patients' => $data]);
    }

    public function viewPatient(Request $request)
    {
        return view('patients.view_profile', ['patient_id' => $request->get('patient_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //send email to notify patient
        $appt = Appointment::find($id);
        $date = (new DateTime($appt->date_of_appointment))->format('l d M Y H:i');
        $message = 'You have cancelled appointment for ' . $date;
        $details = ['receipient' => $appt->Patient->User->email, 'receipient_name' => $appt->Patient->User->name, 'subject' => 'Appointment Cancelled!', 'type' => 'patient_notif', 'message' => $message];

        DB::transaction(function () use ($id) {
            $appt = Appointment::find($id);
            $appt->cancelled = true;
            $appt->save();
        });

        //send email to notify patient
        $this->enqueue($details);

        return redirect()->route('appointments');
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {
            $searchParams = trim($request->get('q'));

            $data = DB::transaction(function () use ($searchParams) {
                $practice_place = Doctor::find(Auth::user()->role_id, ['practice_place']);

                $doctorsUnderSamePlace = Doctor::select('id')
                    ->where('practice_place', '=', $practice_place->practice_place)
                    ->groupBy('id')
                    ->get();

                $doctorPatientAppointment = Appointment::select('patient_id')
                    ->whereIn('doctor_id', $doctorsUnderSamePlace)
                    ->orWhere('doctor_id', '=', Auth::user()->role_id)
                    ->groupBy('patient_id')
                    ->get();

                $doctorPatientReferral = Referral::select('patient_id')
                    ->whereIn('from_doctor_id', $doctorsUnderSamePlace)
                    ->orWhere('from_doctor_id', '=', Auth::user()->role_id)
                    ->orWhere('to_doctor_id', '=', Auth::user()->role_id)
                    ->groupBy('patient_id')
                    ->get();

                $doctorPatient = $doctorPatientAppointment->union($doctorPatientReferral);


                return Patient::whereIn('id', $doctorPatient)
                    ->where(function ($query) use ($searchParams) {
                        $query->where('name', 'like', "%{$searchParams}%")
                            ->orWhere('contact_number', 'like', "%{$searchParams}%");
                    })->paginate(15);
            });

            foreach ($data as $patient) {
                $today = date('Y-m-d');
                $diff = (date_diff(date_create($patient->date_of_birth), date_create($today)))->format('%d');;
                $patient->age = $diff;
            }

            return view('patients.index', ['patients' => $data]);
        } else {
            return redirect()->route(Route::currentRouteName());
        }
    }

    public function viewReferrals()
    {
        $referrals = Referral::where('patient_id', '=', Auth::user()->role_id)
            ->orderByDesc('created_at')
            ->get();

        return view('patients.view_referrals', ['referrals' => $referrals]);
    }

    public function viewAppointments()
    {
        $appointments = Appointment::where('patient_id', '=', Auth::user()->role_id)
            ->orderByDesc('date_of_appointment')
            ->limit(20)
            ->get();

        foreach ($appointments as $appointment) {
            $dateTimeFormat = DateTime::createFromFormat('Y-m-d H:i:s', $appointment->date_of_appointment);
            $date_of_appointment = $dateTimeFormat->format('d M Y ');
            $day_of_appointment = $dateTimeFormat->format('l');
            $time_of_appointment = $dateTimeFormat->format('H:i');
            $appointment->date_of_appointment = $date_of_appointment;
            $appointment->day_of_appointment = $day_of_appointment;
            $appointment->time_of_appointment = $time_of_appointment;
        }

        $upcoming = $appointments->partition(function ($appointment) {
            return ((new DateTime($appointment->date_of_appointment) > new DateTime()) and ($appointment->cancelled == False));
        });

        return view('patients.view_appointments', ['appointments' => $upcoming]);
    }

    public function downloadReferral(Request $request)
    {
        $referral = Referral::find($request->get('id'));

        $encryptedContents = Storage::get($referral->file_path);
        $decryptedContents = Crypt::decrypt($encryptedContents);

        $getDate = (new DateTime($referral->created_at))->format('YmdHis');
        $file_name = "{$getDate}{$referral->from_doctor_id}{$referral->to_doctor_id}_referral.pdf";

        return response()->streamDownload(function () use ($decryptedContents) {
            echo $decryptedContents;
        }, $file_name);
    }

    public function newAppt()
    {
        return view('patients.request_appointment');
    }

    public function changeAppt($id)
    {
        return view('patients.change_appointment', ['id' => $id]);
    }

    public function addPatientRecord(Request $request)
    {
        $patient = Patient::find($request->get('patient_id'), ['id', 'name']);
        return view('patients.add_medical_record', ['patient' => $patient]);
    }

    public function addPatientRecordPost(Request $request)
    {
        Validator::make($request->all(), [
            'name_of_record' => ['required', 'string', 'max:255'],
            'file' => ['mimes:pdf', 'required'],
        ])->validate();

        $encryptedRecord = Crypt::encrypt(file_get_contents($request->file('file')->getRealPath()));
        $filePath = "/public/records/" . time() . Auth::user()->role_id . $request->get('patient_id');

        Storage::put($filePath, $encryptedRecord);

        $pr = Patient_record::create([
            'created_at' => now(),
            'patient_id' => $request->get('patient_id'),
            'doctor_id' => Auth::user()->role_id,
            'name_of_record' => $request->get('name_of_record'),
            'information' => $request->get('information'),
            'file_path' => $request->file('file') ? $filePath : '',
        ]);

        //send email to notify patient
        $message = 'Dr. ' . $pr->Doctor->name . ' has added a new medical record into your profle. Log in to SaveTrace to view/download!';
        $patient = Patient::find($request->get('patient_id'));
        $details = ['receipient' => $patient->User->email, 'receipient_name' => $patient->User->name, 'subject' => 'New Medical Record Added!', 'type' => 'patient_notif', 'message' => $message];
        $this->enqueue($details);

        return redirect()->route('patients.view', ['patient_id' => $request->get('patient_id')]);
    }

    public function downRecord($record_id)
    {
        $patient_record = Patient_record::find($record_id);

        $encryptedContents = Storage::get($patient_record->file_path);
        $decryptedContents = Crypt::decrypt($encryptedContents);

        $getDate = (new DateTime($patient_record->created_at))->format('YmdHis');
        $basicfile = str_replace(' ', '', $patient_record->name_of_record);
        $file_name = "{$getDate}{$patient_record->doctor_id}{$patient_record->patient_id}_{$basicfile}.pdf";

        return response()->streamDownload(function () use ($decryptedContents) {
            echo $decryptedContents;
        }, $file_name);
    }

    public function enqueue($details)
    {
        SendEmail::dispatch($details);
    }
}
