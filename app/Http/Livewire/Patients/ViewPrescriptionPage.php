<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Patient_record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use DateTime;

class ViewPrescriptionPage extends Component
{
    public $prescription;

    public function mount()
    {
        $prescription = Patient_record::where('patient_id', '=', Auth::user()->role_id)
            ->where('is_prescription', '=', 1)
            ->get();
        $this->prescription = $prescription;
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
        return view('livewire.patients.view-prescription-page');
    }
}
