<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Nurse;

class DeleteUserButton extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

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
    public $user;

    /**
     * Mount the component.
     *
     * @param  mixed  $user
     * @return void
     */
    public function mount($userArray)
    {
        $this->user = $userArray;
    }

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatchBrowserEvent('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /**
     * Delete the current user.
     *
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @return void
     */
    public function deleteUser(DeletesUsers $deleter)
    {
        $this->resetErrorBag();

        if (!Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        if ($this->user->role_id) {
            if ($this->user->getRoleNames()->first() == 'internal' or $this->user->getRoleNames()->first() == 'external') {
                Doctor::findOrFail($this->user->role_id)->delete();
            } elseif ($this->user->getRoleNames()->first() == 'nurse') {
                Nurse::findOrFail($this->user->role_id)->delete();
            } elseif ($this->user->getRoleNames()->first() == 'patient') {
                Patient::findOrFail($this->user->role_id)->delete();
            }
        }

        $this->user->removeRole($this->user->roles->first());

        $deleter->delete($this->user->fresh());

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.delete-user-button');
    }
}
