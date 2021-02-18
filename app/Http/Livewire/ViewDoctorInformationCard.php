<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\PracticePlace;

class ViewDoctorInformationCard extends Component
{
    public $doctor;

    public function mount($doctor_id)
    {
        $this->doctor = Doctor::withTrashed()
            ->find($doctor_id, ['name', 'registration_number', 'email', 'contact', 'fax', 'internal', 'specialty', 'profile_photo_path', 'information', 'practice_place'])
            ->toArray();

        $this->doctor['practice_place_details'] = PracticePlace::find($this->doctor['practice_place'])->toArray();
    }

    public function render()
    {
        return view('livewire.view-doctor-information-card');
    }
}
