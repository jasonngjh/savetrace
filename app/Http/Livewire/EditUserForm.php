<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Spatie\Permission\Models\Role;


class EditUserForm extends Component
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

    public $roles = [];

    public function mount($user)
    {
        $this->state = $user->toArray();
        $userRoles = reset($this->state['roles']);
        $this->state['roles'] = $userRoles['name'];

        $this->roles = Role::where('name', '!=', 'patient')
            ->get();
    }

    public function editUser(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        $user = User::find($this->state['id']);
        $updater->update($user, $this->photo ? array_merge($this->state, ['photo' => $this->photo])
            : $this->state);

        $user->syncRoles([$this->state['roles']]);

        if ($user->role_id) {
            if ($user->hasRole(['internal', 'external'])) {
                $doctor = Doctor::find($user->role_id);
                $doctor->profile_photo_path = $user->profile_photo_path;
                $doctor->save();
            } else {
                $patient = Patient::find($user->role_id);
                $patient->profile_photo_path = $user->profile_photo_path;
                $patient->save();
            }
        }

        if ($user->id == Auth::user()->id) {
            $this->emit('refresh-navigation-menu');
        }

        return redirect()->route('users.edit', ['userId' => $user->id, 'message' => $user->name . ' has been successfully saved']);
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        $user = User::find($this->state['id']);
        $user->deleteProfilePhoto();

        if ($user->role_id) {
            if ($user->hasRole(['internal', 'external'])) {
                $doctor = Doctor::find($user->role_id);
                $doctor->profile_photo_path = null;
                $doctor->save();
            } else {
                $patient = Patient::find($user->role_id);
                $patient->profile_photo_path = null;
                $patient->save();
            }
        }

        if ($user->id == Auth::user()->id) {
            $this->emit('refresh-navigation-menu');
        }
        return redirect()->route('users.edit', ['userId' => $user->id, 'message' => $user->name . ' has been successfully saved']);
    }

    public function render()
    {
        return view('livewire.edit-user-form');
    }
}
