<?php

namespace App\Http\Livewire\Doctors;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PatientSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
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

            return $doctorPatient;
        });

        $patients = Patient::select('id as value', 'name as description')
            ->whereIn('id', $data)
            ->get();

        return $patients;
    }

    public function selectedOption($value)
    {
        $patient = Patient::select('id', 'name')
            ->where('id', '=', $value)
            ->get();

        return [
            'value' => $patient->first()->id,
            'description' => $patient->first()->name,
        ];
    }
}
