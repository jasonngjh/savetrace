<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Referral;
use \DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class DoctorReferralsTabs extends Component
{
    public $sent = true;
    public $referralSent;
    public $referralReceived;
    public $doctor_id;

    public function mount($doctor_id)
    {
        $this->$doctor_id = $doctor_id;
        $this->referralSent = Referral::where('from_doctor_id', '=', $doctor_id)
            ->limit(15)
            ->get();

        $this->referralReceived = Referral::where('to_doctor_id', '=', $doctor_id)
            ->limit(15)
            ->get();
    }

    public function patientVisited($referral_id)
    {
        $referral = Referral::find($referral_id);
        date_default_timezone_set("Asia/Singapore");
        $referral->visited_on = (new DateTime('now'))->format('Y-m-d H:i');
        $referral->save();

        return redirect()->route('doctors.view', ['id' => $this->doctor_id]);
    }

    public function downloadReferral($referral_id)
    {
        $referral = Referral::find($referral_id);

        $encryptedContents = Storage::get($referral->file_path);
        $decryptedContents = Crypt::decrypt($encryptedContents);

        $getDate = (new DateTime($referral->created_at))->format('YmdHis');
        $file_name = "{$getDate}{$referral->from_doctor_id}{$referral->to_doctor_id}_referral.pdf";

        return response()->streamDownload(function () use ($decryptedContents) {
            echo $decryptedContents;
        }, $file_name);
    }

    public function render()
    {
        return view('livewire.doctor-referrals-tabs');
    }
}
