<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Nurse;
use App\Models\PracticePlace;
use App\Models\Doctor;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use \DateTime;

class Homepage extends Component
{
    use WithPagination;
    private $doctors_id;

    public $pastWeek = false;
    public $days;

    public $selectedWeek = false;
    public $selectedMonth = false;
    public $selected3Month = false;
    public $selectedYear = false;

    public function mount()
    {
        $nurse = Nurse::where('user_id', '=', Auth::user()->id)
            ->get();

        $doctors_id = Doctor::select('id')
            ->where('practice_place', '=', $nurse->first()->practice_place)
            ->groupBy('id')
            ->get();

        $doctorsArray = array();

        foreach ($doctors_id as $doctor) {
            array_push($doctorsArray, $doctor->id);
        }

        $this->doctors_id = $doctorsArray;
    }

    public function filterWeek()
    {
        $this->days = \Carbon\Carbon::today()->subDays(7);
        $this->mount();
    }

    public function filterMonth()
    {
        $this->days = \Carbon\Carbon::today()->subDays(30);
        $this->mount();
    }

    public function filterThreeMonth()
    {
        $this->days = \Carbon\Carbon::today()->subDays(90);
        $this->mount();
    }

    public function filterYear()
    {
        $this->days = \Carbon\Carbon::today()->subDays(365);
        $this->mount();
    }

    public function clearFilter()
    {
        $this->days = null;
        $this->mount();
    }

    public function patientVisited($referral_id)
    {
        $referral = Referral::find($referral_id);
        date_default_timezone_set("Asia/Singapore");
        $referral->visited_on = (new DateTime('now'))->format('Y-m-d H:i');
        $referral->save();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.employees.homepage', [
            'sent_referrals' => Referral::where('created_at', '>=', $this->days ? $this->days : \Carbon\Carbon::today()->subDays(0))
                ->whereIn('from_doctor_id', $this->doctors_id)
                ->orderBy('created_at')
                ->paginate(30),

            'received_referrals' => Referral::where('created_at', '>=', $this->days ? $this->days : \Carbon\Carbon::today()->subDays(0))
                ->whereIn('to_doctor_id', $this->doctors_id)
                ->orderBy('created_at')
                ->paginate(30),
        ]);
    }
}
