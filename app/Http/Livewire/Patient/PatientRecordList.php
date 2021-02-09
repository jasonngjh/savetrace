<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\Patient_record;

class PatientRecordList extends Component
{
    public $patient_record;

    public function mount($patient_id)
    {
        $this->patient_record = Patient_record::where('patient_id', '=', $patient_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.patient.patient-record-list');
    }
}
