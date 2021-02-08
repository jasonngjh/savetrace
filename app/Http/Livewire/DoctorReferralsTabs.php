<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Referral;
use \DateTime;

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

    public function render()
    {
        return view('livewire.doctor-referrals-tabs');
    }
}
