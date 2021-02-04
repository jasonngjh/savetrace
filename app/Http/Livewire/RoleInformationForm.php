<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\PracticePlace;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RoleInformationForm extends Component
{
    public $userRole = '';
    public $state = [];
    public $user_role_id = '';

    public function mount($user)
    {
        $this->userRole = $user->roles->first()->name;
        $this->user_role_id = $user->role_id;

        if ($this->userRole == 'patient') {
            $this->state = Patient::find($user->role_id)->toArray();
        } elseif ($this->userRole == 'internal' || $user->roles->first()->name == 'external') {
            $this->state = Doctor::find($user->role_id)->toArray();
            $practice_place = PracticePlace::find($this->state['practice_place']);
            $this->state['practice_place_name'] = $practice_place->name;
        }
    }

    public function updateRoleInformation()
    {
        $this->resetErrorBag();

        if ($this->userRole == "patient") {
            Validator::make($this->state, [
                'name_of_emergency_contact' => ['required_with:contact_number_of_emergency_contact', 'string', 'max:255'],
                'contact_number_of_emergency_contact' => ['numeric', 'required_with:name_of_emergency_contact'],
            ])->validate();

            $patient = Patient::find($this->user_role_id);
            $patient->name_of_emergency_contact = $this->state['name_of_emergency_contact'];
            $patient->contact_number_of_emergency_contact = $this->state['contact_number_of_emergency_contact'];
            $patient->allergies = $this->state['allergies'];
            $patient->save();
        } else {
            Validator::make($this->state, [
                'specialty' => ['required', 'string', 'max:255'],
                'fax' => ['numeric', 'nullable'],
            ])->validate();

            $doctor = Doctor::find($this->user_role_id);
            $doctor->specialty = $this->state['specialty'];
            $doctor->fax = $this->state['fax'];
            $doctor->information = $this->state['information'];
            $doctor->save();
        }
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.role-information-form');
    }
}
