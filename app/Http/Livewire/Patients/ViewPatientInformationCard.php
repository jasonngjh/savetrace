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
        $diff = (date_diff(date_create($this->patient->date_of_birth), date_create($today)))->format('%d');;
        $this->patient->age = $diff;
    }

    public function render()
    {
        return view('livewire.patients.view-patient-information-card');
    }
}
