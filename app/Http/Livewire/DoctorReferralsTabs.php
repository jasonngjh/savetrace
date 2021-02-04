<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Referral;

class DoctorReferralsTabs extends Component
{
    public $sent = true;
    public $referralSent = [];
    public $referralReceived = [];

    public function mount($doctor_id)
    {
    }

    public function render()
    {
        return view('livewire.doctor-referrals-tabs');
    }
}
