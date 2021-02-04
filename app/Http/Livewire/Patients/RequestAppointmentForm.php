<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Appointment;

class RequestAppointmentForm extends Component
{


    public function render()
    {
        return view('livewire.patients.request-appointment-form');
    }
}
