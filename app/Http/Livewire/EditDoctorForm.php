<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class EditDoctorForm extends Component
{
    use WithFileUploads;
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];
    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;
    public $route;

    protected $listeners = [
        'user_idUpdated' => 'setUserId',
    ];

    public function mount($doctor)
    {
        $this->state = $doctor->toArray();

        $user = User::find($this->state['user_id']);
        if ($user) {
            $user_details = $user->name . " - " . $user->email;
            $this->state['user_details'] = $user_details;
        }
        $this->route = Route::currentRouteName();
    }

    public function setUserId($object)
    {
        $this->state['user_id'] = $object['value'];
    }

    public function editDoctor()
    {
        Validator::make($this->state, [
            'registration_number' => ['string', 'max:255', 'required',],
            'name' => ['string', 'max:255', 'required'],
            'specialty' => ['string', 'max:255', 'required'],
        ])->validate();

        $doctor = Doctor::find($this->state['id']);

        if (isset($this->photo)) {
            $doctor->updateProfilePhoto($this->photo);
        }

        $doctor->forceFill([
            'registration_number' => $this->state['registration_number'],
            'name' => $this->state['name'],
            'specialty' => $this->state['specialty'],
            'user_id' => $this->state['user_id'],
        ])->save();

        return redirect()->route($this->route, ['doctorId' => $doctor->id]);
    }

    public function unlink()
    {
        unset($this->state['user_details']);
        $this->state['user_id'] = null;
    }

    /**
     * Delete doctor's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        $doctor = Doctor::find($this->state['id']);
        $doctor->deleteProfilePhoto();

        return redirect()->route($this->route, ['doctorId' => $doctor->id]);
    }

    public function render()
    {
        return view('livewire.edit-doctor-form');
    }
}
