<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Patient;
use App\Models\Referral;
use App\Models\Appointment;
use DateTime;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $output->writeln("");

        if ($request->filled('q')) {
            $searchParams = trim($request->get('q'));


            $data = Patient::where(function ($query) use ($searchParams) {
                $query->where('name', 'like', "%{$searchParams}%")
                    ->orWhere('contact_number', 'like', "%{$searchParams}%");
            })->paginate(15);

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

    public function newAppt()
    {
        return view('patients.request_appointment');
    }

    public function changeAppt($id)
    {
        return view('patients.change_appointment', ['id' => $id]);
    }
}
