<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\PracticePlace;

class DoctorInformationComponent extends Component
{
    public $doctor_information;

    public function mount($doctor_id)
    {
        $this->doctor_information = Doctor::select('email', 'fax', 'information', 'practice_place')
            ->withTrashed()
            ->with('PracticePlace')
            ->where('id', '=', $doctor_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.doctor-information-component');
    }
}
