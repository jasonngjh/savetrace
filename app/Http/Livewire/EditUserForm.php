<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
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