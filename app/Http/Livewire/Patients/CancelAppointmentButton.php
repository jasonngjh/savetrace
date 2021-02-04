<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class CancelAppointmentButton extends Component
{
    /**
     * Indicates if appointment cancellation is being confirmed.
     *
     * @var bool
     */
    public $confirmingAppointmentCancellation = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * The selected appt id
     *
     * @var mixed
     */
    public $appt_id;

    public function mount($appt_id)
    {
        $this->appt_id = $appt_id;
    }

    public function cancelAppt()
    {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        DB::transaction(function () {
            $appt = Appointment::find($this->appt_id);
            $appt->cancelled = true;
            $appt->save();
        });

        return redirect()->route('appointments');
    }

    public function confirmCancelAppointment()
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->dispatchBrowserEvent('confirming-cancel-appt');
        $this->confirmingAppointmentCancellation = true;
    }

    public function render()
    {
        return view('livewire.patients.cancel-appointment-button');
    }
}
