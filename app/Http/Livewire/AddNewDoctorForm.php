<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PracticePlace;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class AddNewDoctorForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $photo;
    public $query;
    public $practice_names;
    public $route;
    public $practice_place;

    public $link = true;

    protected $listeners = [
        'practice_placeUpdated' => 'setPracticePlace',
    ];

    public function toggleLink()
    {
        $this->link = !$this->link;
    }

    public function setPracticePlace($object)
    {
        $this->state['pp_id'] = $object['value'];
    }

    public function mount()
    {
        $this->route = strtok(Route::currentRouteName(), '.');
    }

    public function addNewDoctor()
    {
        $this->resetErrorBag();

        if ($this->link) {
            Validator::make($this->state, [
                'registration_number' => ['required', 'unique:doctors', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'specialty' => ['required', 'string', 'max:255'],
                'email' => ['email', 'string', 'max:255'],
                'contact' => ['numeric'],
                'fax' => ['numeric'],
                'pp_id' => ['required']
            ])->validate();
        } else {
            Validator::make($this->state, [
                'registration_number' => ['required', 'unique:doctors', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'specialty' => ['required', 'string', 'max:255'],
                'email' => ['email', 'string', 'max:255'],
                'contact' => ['numeric'],
                'fax' => ['numeric'],
                'place_of_practice_name' => ['required'],
                'place_of_practice_address' => ['required'],
                'place_of_practice_tel' => ['required', 'numeric'],
                'place_of_practice_area' => ['required']
            ])->validate();

            $place_of_practice = PracticePlace::create([
                'name' => $this->state['place_of_practice_name'],
                'address' => $this->state['place_of_practice_address'],
                'tel' => $this->state['place_of_practice_tel'],
                'area' => $this->state['area'],
                'opening_time' => $this->state['place_of_practice_opening_time'] ?? null,
                'created_at' => now(),
            ]);
        }

        Doctor::create([
            'name' => $this->state['name'],
            'registration_number' => $this->state['registration_number'],
            'internal' => ($this->route == "internaldocs") ? true : false,
            'specialty' => $this->state['specialty'],
            'email' => $this->state['email'] ?? null,
            'contact' => $this->state['contact'] ?? null,
            'fax' => $this->state['fax'] ?? null,
            'information' => $this->state['information'] ?? null,
            'practice_place' => ($this->link) ? $this->state['pp_id'] : $place_of_practice->id,
            'created_at' => now(),
        ]);

        return redirect()->route($this->route);
    }

    public function render()
    {
        return view('livewire.add-new-doctor-form');
    }
}
