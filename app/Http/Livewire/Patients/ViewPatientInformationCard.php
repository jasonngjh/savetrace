<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Patient;

class ViewPatientInformationCard extends Component
{
    public $patient;

    public function mount($patient_id)
    {
        $this->patient = Patient::find($patient_id);
        $today = date('Y-m-d');
        $diff = date_diff(date_create($this->patient->date_of_birth), date_create($today));

        if ($diff->y == 0) {
            if ($diff->m == 0) {
                $this->patient->age = $diff->d . " days old";
            } else {
                $this->patient->age = $diff->m . " months old";
            }
        } else {
            $this->patient->age = $diff->y . " years old";
        }
    }

    public function render()
    {
        return view('livewire.patients.view-patient-information-card');
    }
}
