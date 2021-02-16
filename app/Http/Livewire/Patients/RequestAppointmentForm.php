<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\PracticePlace;
use App\Models\Doctor;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmail;

class RequestAppointmentForm extends Component
{
    public $area = '';

    public $displayArea = false;
    public $displayDoctor = false;
    public $displayDateTime = false;
    public $displayTime = false;
    public $displaySubmitButton = false;
    public $confirmingSubmit = false;

    public $listOfPlaceInArea;
    public $place;
    public $doctor;
    public $listOfDoctors;
    public $appt_time = array();

    public $selectedDate = '';
    public $selectedTime = '';
    public $selectedDoctor;

    public function mount()
    {
        $startTime = (new \DateTime('08:30'))->format('H:i');
        $endTime = '18:00';

        array_push($this->appt_time, $startTime);
        do {
            $newTime = (new \DateTime(end($this->appt_time)))->add(new DateInterval('PT' . 30 . 'M'));
            array_push($this->appt_time, $newTime->format('H:i'));
        } while (strcmp(end($this->appt_time), $endTime) == true);
    }

    public function setApptTime()
    {
        unset($this->appt_time);
        $this->appt_time = array();
    }

    public function getArea($area)
    {
        $this->displayArea = false;
        $this->displayDoctor = false;

        $this->listOfPlaceInArea = PracticePlace::select('id', 'name')
            ->where('area', '=', $area)
            ->get();

        $this->displayArea = true;
    }

    public function updatedPlace()
    {
        $this->displayDoctor = false;
        $this->listOfDoctors = Doctor::select('id', 'name', 'specialty')
            ->where('practice_place', '=', $this->place)
            ->get();
        $this->displayDoctor = true;
    }

    public function updatedDoctor()
    {
        $this->displayDateTime = false;
        $this->displayDateTime = true;
        $this->selectedDoctor = Doctor::select('id', 'name', 'specialty')
            ->where('id', '=', $this->doctor)
            ->get();
    }

    public function updatedselectedDate()
    {
        $this->resetErrorBag();
        $this->displayTime = false;
        $time = strtotime($this->selectedDate);
        $newformat = date('Y-m-d', $time);
        $data = ['selectedDate' => $newformat];

        Validator::make($data, [
            'selectedDate' => ['required', 'after:today']
        ])->validate();

        $this->displayTime = true;
    }

    public function updatedselectedTime()
    {
        $this->displaySubmitButton = true;
    }

    public function confirmSubmit()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('confirming-submit-appt');
        $this->confirmingSubmit = true;
    }

    public function submitAppt()
    {
        Appointment::create([
            'patient_id' => Auth::user()->role_id,
            'doctor_id' => $this->selectedDoctor->first()->id,
            'date_of_appointment' => (new \DateTime($this->selectedDate . $this->selectedTime))->format('Y-m-d H:i:s'),
        ]);

        $date = (new \DateTime($this->selectedDate . $this->selectedTime))->format('l d M Y H:i');
        $message = 'You have requested an appointment for ' . $date . ' with Dr. ' . $this->selectedDoctor->first()->name;
        $details = ['receipient' => Auth::user()->email, 'receipient_name' => Auth::user()->name, 'subject' => 'Appointment Requested!', 'type' => 'patient_notif', 'message' => $message];
        $this->enqueue($details);

        return redirect()->route('appointments');
    }

    public function render()
    {
        return view('livewire.patients.request-appointment-form');
    }

    public function enqueue($details)
    {
        SendEmail::dispatch($details);
    }
}
