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
                'pp_id' => ['required']
            ])->validate();
        } else {
            Validator::make($this->state, [
                'registration_number' => ['required', 'unique:doctors', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'specialty' => ['required', 'string', 'max:255'],
                'place_of_practice_name' => ['required'],
                'place_of_practice_address' => ['required'],
                'place_of_practice_tel' => ['required'],
            ])->validate();

            $place_of_practice = PracticePlace::create([
                'name' => $this->state['place_of_practice_name'],
                'address' => $this->state['place_of_practice_address'],
                'tel' => $this->state['place_of_practice_tel'],
                'created_at' => now(),
            ]);
        }

        Doctor::create([
            'name' => $this->state['name'],
            'registration_number' => $this->state['registration_number'],
            'internal' => ($this->route == "internaldocs") ? true : false,
            'specialty' => $this->state['specialty'],
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
