<?php

namespace App\Http\Livewire\Doctors;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Referral;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class Homepage extends Component
{
    public $confirmed_appointments;
    public $today_date;
    public $pending_appointments;
    public $referrals;

    public function mount()
    {
        $this->today_date = (new DateTime())->format('l d M Y');
        $this->confirmed_appointments = Appointment::select('patient_id', 'date_of_appointment')
            ->where('doctor_confirmation', '=', True)
            ->where('cancelled', '=', False)
            ->where('doctor_id', '=', Auth::user()->role_id)
            ->whereDate('date_of_appointment', today())
            ->get();

        $this->pending_appointments = Appointment::select('id', 'patient_id', 'date_of_appointment')
            ->where('doctor_id', '=', Auth::user()->role_id)
            ->where('cancelled', '=', False)
            ->where('doctor_confirmation', '=', False)
            ->whereDate('date_of_appointment', '>=', today())
            ->orderBy('date_of_appointment')
            ->get();

        $this->referrals = Referral::select('id', 'patient_id', 'from_doctor_id')
            ->where('to_doctor_id', '=', Auth::user()->role_id)
            ->where('viewed', '=', False)
            ->get();

        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($this->referrals);
    }

    public function acceptAppt($appt_id)
    {
        $appt = Appointment::find($appt_id);
        $appt->doctor_confirmation = True;
        $appt->save();

        $this->mount();
        return redirect()->route('home');
    }

    public function rejectAppt($appt_id)
    {
        $appt = Appointment::find($appt_id);
        $appt->cancelled = False;
        $appt->save();

        $this->mount();
        return redirect()->route('home');
    }

    public function viewReferral($referral_id)
    {
        $referral = Referral::find($referral_id);
        $referral->viewed = True;
        $referral->save();

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
        return view('livewire.doctors.homepage');
    }
}
