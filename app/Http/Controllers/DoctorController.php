<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\PracticePlace;
use App\Models\Referral;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmail;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctors.dashboard');
    }

    public function admin_main()
    {
        $internal = (Route::currentRouteName() == "internaldocs") ? true : false;

        $data = Doctor::where('internal', '=', $internal)
            ->paginate(15);

        foreach ($data as $doctor) {
            $nameofpractice = PracticePlace::find($doctor->practice_place);
            $doctor['practice_place_name'] = $nameofpractice->name;
        }

        return view('doctors.main', ['docData' => $data]);
    }

    public function retrieve_all_doctors()
    {
        $data = Doctor::paginate(15, ['id', 'name', 'registration_number', 'email', 'specialty', 'practice_place']);

        foreach ($data as $doctor) {
            $nameofpractice = PracticePlace::find($doctor->practice_place);
            $doctor['practice_place_name'] = $nameofpractice->name;
        }

        return view('doctors.view_all_doctors', ['docData' => $data]);
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {
            $searchParams = trim($request->get('q'));

            $internal = (strtok(Route::currentRouteName(), '.') == "internaldocs") ? true : false;

            $data = Doctor::where('internal', '=', $internal)
                ->where(function ($query) use ($searchParams) {
                    $query->where('name', 'like', "%{$searchParams}%")
                        ->orWhere('registration_number', 'like', "%{$searchParams}%")
                        ->orWhere('specialty', 'like', "%{$searchParams}%");
                })->paginate(15);

            foreach ($data as $doctor) {
                $nameofpractice = PracticePlace::find($doctor->practice_place);
                $doctor['practice_place_name'] = $nameofpractice->name;
            }

            return view('doctors.main', ['docData' => $data]);
        } else {
            return redirect()->route(strtok(Route::currentRouteName(), '.'));
        }
    }

    public function add()
    {
        return view('doctors.add');
    }

    public function edit(Request $request)
    {
        $doctor = Doctor::find($request->get("doctorId"));
        $practice_place = PracticePlace::find($doctor->practice_place);
        $doctor->practice_place_details = $practice_place;

        return view('doctors.edit', ['doctor' => $doctor, 'message' => $request->get('message')]);
    }

    public function view(Request $request, $id)
    {
        return view('doctors.view', ['id' => $id]);
    }

    public function addReferral($to_doctor)
    {
        return view('doctors.add_referral', ['to_doctor' => $to_doctor]);
    }

    public function addReferralPost(Request $request)
    {
        Validator::make($request->all(), [
            'file' => ['mimes:pdf', 'required'],
        ])->validate();

        $encryptedReferral = Crypt::encrypt(file_get_contents($request->file('file')->getRealPath()));
        $filePath = "/public/referrals/" . time() . Auth::user()->role_id . $request->get('doctor_id');

        Storage::put($filePath, $encryptedReferral);

        $referral = Referral::create([
            'created_at' => now(),
            'patient_id' => $request->get('patient'),
            'from_doctor_id' => Auth::user()->role_id,
            'to_doctor_id' => $request->get('doctor_id'),
            'file_path' => $request->file('file') ? $filePath : '',
        ]);

        $this->enqueue($referral);

        return redirect()->route('doctors.view', ['id' => $request->get('doctor_id')]);
    }

    public function enqueue($referral)
    {
        $details = ['receipient' => $referral->To_Doctor->email, 'receipient_name' => 'Dr. ' . $referral->To_Doctor->name, 'subject' => 'Received new referral', 'type' => 'referral', 'id' => $referral->id, 'message' => 'You have received a new referral. Please log in to SaveTrace to view the referral'];
        SendEmail::dispatch($details);

        $details = ['receipient' => $referral->Patient->User->email, 'receipient_name' => $referral->Patient->name, 'subject' => 'Received new referral', 'type' => 'referral', 'id' => $referral->id, 'message' => 'You have received a new referral. Please log in to SaveTrace to view the referral'];
        SendEmail::dispatch($details);

        $message = 'You have successfully sent a new referral to Dr. ' . $referral->To_Doctor->name . ' on ' . $referral->created_at;
        $details = ['receipient' => $referral->From_doctor->email, 'receipient_name' => 'Dr. ' . $referral->From_doctor->name, 'subject' => 'Successfully sent referral', 'type' => 'referral', 'id' => $referral->id, 'message' => $message];
        SendEmail::dispatch($details);
    }
}
