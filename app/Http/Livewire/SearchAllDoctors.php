<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;


class SearchAllDoctors extends Component
{

    public $q;
    public $doctors;

    public function mount()
    {
        $this->doctors = Doctor::all();
    }

    public function updated()
    {
        $this->doctors = Doctor::where('name', 'like', '%' . $this->q . '%')
            ->orWhere('specialty', 'like', '%' . $this->q . '%')
            ->orWhere('email', 'like', '%' . $this->q . '%')
            ->orWhere('contact', 'like', '%' . $this->q . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.search-all-doctors', [
            'doctors' => $this->doctors,
        ]);
    }
}
