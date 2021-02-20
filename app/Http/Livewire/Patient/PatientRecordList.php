<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\Patient_record;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use DateTime;

class PatientRecordList extends Component
{
    public $patient_record;

    public function mount($patient_id)
    {
        $this->patient_record = Patient_record::where('patient_id', '=', $patient_id)
            ->get();
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

    public function render()
    {
        return view('livewire.patient.patient-record-list');
    }
}
