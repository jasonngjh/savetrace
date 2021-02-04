<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\PracticePlace;
use Illuminate\Support\Facades\Route;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctors.dashboard');
    }

    public function admin_main()
    {
        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $output->writeln("Route in index: " . Route::currentRouteName());

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
}
