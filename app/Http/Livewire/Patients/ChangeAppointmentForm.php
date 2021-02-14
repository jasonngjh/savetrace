<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Appointment;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;

class ChangeAppointmentForm extends Component
{
    public $appt_time = array();
    public $appt;
    public $curr_date;
    public $curr_time;
    public $displaySubmitButton = false;
    public $selectedDate = '';
    public $selectedTime = '';

    public $dateSelected = false;
    public $timeSelected = false;
    public $confirmingSubmit = false;

    public function mount($appt_id)
    {
        $this->appt = Appointment::find($appt_id);
        $date = new \DateTime($this->appt->date_of_appointment);
        $this->curr_date = $date->format('l M d Y');
        $this->curr_time = $date->format('H:i');

        $startTime = (new \DateTime('08:30'))->format('H:i');
        $endTime = '18:00';
        array_push($this->appt_time, $startTime);
        do {
            $newTime = (new \DateTime(end($this->appt_time)))->add(new DateInterval('PT' . 30 . 'M'));
            array_push($this->appt_time, $newTime->format('H:i'));
        } while (strcmp(end($this->appt_time), $endTime) == true);
    }

    public function updatedselectedDate()
    {
        $this->resetErrorBag();
        $this->dateSelected = false;

        $time = strtotime($this->selectedDate);
        $newformat = date('Y-m-d', $time);
        $data = ['selectedDate' => $newformat];

        Validator::make($data, [
            'selectedDate' => ['required', 'after_or_equal:today']
        ])->validate();
        $this->dateSelected = true;
    }

    public function updatedselectedTime()
    {
        $this->timeSelected = true;
    }

    public function confirmSubmit()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('confirming-submit-appt');
        $this->confirmingSubmit = true;
    }

    public function changeAppt()
    {
        $thisDate = $this->selectedDate == '' ? (new \DateTime($this->appt->date_of_appointment))->format('Y-m-d') : $this->selectedDate;
        $thisTime = $this->selectedTime == '' ? (new \DateTime($this->appt->date_of_appointment))->format('H:i') : $this->selectedTime;
        $date = new \DateTime($thisDate . ' ' . $thisTime);

        DB::transaction(function () use ($date) {
            $this->appt->date_of_appointment = $date;
            $this->appt->doctor_confirmation = false;
            $this->appt->save();
        });

        //send email to notify patient
        $date = $date->format('l d M Y H:i');
        $message = 'You have change the appointment date and time to ' . $date;
        $details = ['receipient' => $this->appt->Patient->User->email, 'receipient_name' => $this->appt->Patient->User->name, 'subject' => 'Appointment Changed!', 'type' => 'patient_notif', 'message' => $message];
        $this->enqueue($details);

        return redirect()->route('appointments');
    }

    public function render()
    {
        return view('livewire.patients.change-appointment-form');
    }

    public function enqueue($details)
    {
        SendEmail::dispatch($details);
    }
}
