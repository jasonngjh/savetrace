<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use App\Models\Doctor;

class AddUserAccountForm extends Component
{
    use PasswordValidationRules;

    public $roles = [];
    public $state = [];

    public $link = false;

    protected $listeners = [
        'role_idUpdated' => 'setRoleId',
    ];

    public function setRoleId($object)
    {
        $this->state['role_id'] = $object['value'];
    }

    public function mount()
    {
        $this->roles = Role::select('id', 'name')
            ->where('name', '!=', 'patient')
            ->get()
            ->toArray();
    }

    public function toggleLink()
    {
        $this->link = !$this->link;
    }

    public function addUserAccount(CreatesNewUsers $creator)
    {
        Validator::make($this->state, [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['numeric'],
            'password' => $this->passwordRules(),
        ])->validate();
        // $this->state['password_confirmation'] = $this->state['password'];

        event(new Registered($user = $creator->create($this->state)));

        $user->syncRoles($this->state['role']);

        if (array_key_exists('role_id', $this->state)) {
            $user->forceFill([
                'role_id' => $this->state['role_id'],
            ])->save();

            $doctor = Doctor::find($this->state['role_id']);
            $doctor->user_id = $user->id;
            $doctor->save();
        }

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.add-user-account-form');
    }
}
