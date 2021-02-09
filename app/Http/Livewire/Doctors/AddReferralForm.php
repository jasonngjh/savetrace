<?php

namespace App\Http\Livewire\Doctors;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Referral;
use Livewire\WithFileUploads;

class AddReferralForm extends Component
{
    use WithFileUploads;

    public $to_doctor;

    public $file;

    public function mount($to_doctor)
    {
        $this->to_doctor = Doctor::find($to_doctor, ['id', 'name', 'practice_place']);
    }

    public function render()
    {
        return view('livewire.doctors.add-referral-form');
    }
}
