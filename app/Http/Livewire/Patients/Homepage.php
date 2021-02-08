<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Support\Facades\Storage;

class Homepage extends Component
{
    public $medical_records;

    public function mount()
    {
        $records = Patient::find(Auth::user()->role_id)
            ->Patient_record;
        $this->medical_records = $records;
    }

    public function downRecord($record_path)
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($record_path);
        return Storage::download('public/' . $record_path);
    }

    public function render()
    {
        return view('livewire.patients.homepage');
    }
}
