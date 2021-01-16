<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeleteDoctorButton extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingDoctorDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * The selected user id
     *
     * @var mixed
     */
    public $doctor;

    public $route;

    public function mount($doctor)
    {
        $this->doctor = $doctor;
        $this->route = strtok(Route::currentRouteName(), '.');
    }

    public function confirmDoctorDeletion()
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->dispatchBrowserEvent('confirming-delete-doctor');
        $this->confirmingDoctorDeletion = true;
    }

    public function deleteDoctor()
    {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $doctor = Doctor::find($this->doctor['id']);

        if ($doctor->user_id != null) {
            $this->removeRoleIdFromUser($doctor);
        }
        $doctor->delete();

        return redirect()->route($this->route);
    }

    protected function removeRoleIdFromUser($doctor)
    {
        $user = User::find($doctor->user_id);
        $user->forceFill([
            'role_id' => null,
        ])->save();
    }

    public function render()
    {
        return view('livewire.delete-doctor-button');
    }
}
