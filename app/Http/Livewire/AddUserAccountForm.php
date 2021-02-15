<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\PracticePlace;
use Illuminate\Support\Facades\DB;

class AddUserAccountForm extends Component
{
    use PasswordValidationRules;

    public $roles = [];
    public $state = [];

    public $user_link = false;
    public $practice_place_link = false;

    protected $listeners = [
        'role_idUpdated' => 'setRoleId',
        'practice_placeUpdated' => 'setPracticePlace',
    ];

    public function setRoleId($object)
    {
        $this->state['role_id'] = $object['value'];
    }

    public function setPracticePlace($object)
    {
        $this->state['practice_place'] = $object['value'];
    }

    public function mount()
    {
        $this->roles = Role::select('id', 'name')
            ->where('name', '!=', 'patient')
            ->get()
            ->toArray();
    }

    public function toggleUserLink()
    {
        $this->user_link = !$this->user_link;
    }

    public function togglePractice_place_link()
    {
        $this->practice_place_link = !$this->practice_place_link;
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

        if ($this->user_link) {
            Validator::make($this->state, [
                'role_id' => ['required']
            ])->validate();
        } else {
            if ($this->practice_place_link) {
                $output = new \Symfony\Component\Console\Output\ConsoleOutput();
                $output->writeln($this->state);
                Validator::make($this->state, [
                    'practice_place' => ['required']
                ])->validate();
                $output->writeln("validate practice place");
            } else {
                Validator::make($this->state, [
                    'place_of_practice_name' => ['required'],
                    'place_of_practice_address' => ['required'],
                    'place_of_practice_tel' => ['required', 'numeric'],
                    'place_of_practice_area' => ['required']
                ])->validate();
            }
            if ($this->state['role'] == 2 || $this->state['role'] == 3) {
                Validator::make($this->state, [
                    'registration_number' => ['required'],
                    'specialty' => ['required']
                ])->validate();
            }
        }

        DB::transaction(function () use ($creator) {
            event(new Registered($user = $creator->create($this->state)));

            $user->syncRoles($this->state['role']);

            if (array_key_exists('role_id', $this->state)) {
                if ($this->state['role'] == 2 || $this->state['role'] == 3) {
                    $user->forceFill([
                        'role_id' => $this->state['role_id'],
                    ])->save();

                    $doctor = Doctor::find($this->state['role_id']);
                    $doctor->user_id = $user->id;
                    $doctor->save();
                } elseif ($this->state['role'] == 4) {
                    $user->forceFill([
                        'role_id' => $this->state['role_id'],
                    ])->save();

                    $nurse = Nurse::find($this->state['role_id']);
                    $nurse->user_id = $user->id;
                    $nurse->save();
                }
            } else {
                if (!$this->practice_place_link) {
                    $practice_place = PracticePlace::create([
                        'name' => $this->state['place_of_practice_name'],
                        'address' => $this->state['place_of_practice_address'],
                        'tel' => $this->state['place_of_practice_tel'],
                        'area' => $this->state['place_of_practice_area'],
                        'opening_time' => $this->state['place_of_practice_opening_time'] ?? null,
                    ]);
                }

                if ($this->state['role'] == 2 || $this->state['role'] == 3) {
                    //create doctor
                    $doctor = Doctor::create([
                        'name' => $this->state['name'],
                        'registration_number' => $this->state['registration_number'],
                        'email' => $this->state['email'],
                        'contact' => $this->state['contact_number'],
                        'internal' => $this->state['role'] == 2 ? True : False,
                        'specialty' => $this->state['specialty'],
                        'information' => $this->state['information'] ?? null,
                        'practice_place' => $this->state['pp_id'] ?? $practice_place->id,
                        'user_id' => $user->id,
                    ]);

                    $user->role_id = $doctor->id;
                    $user->save();
                } elseif ($this->state['role'] == 4) {
                    $nurse = Nurse::create([
                        'practice_place' => $this->state['practice_place'] ?? $practice_place->id,
                        'user_id' => $user->id,
                    ]);
                    $user->role_id = $nurse->id;
                    $user->save();
                }
            }
        });
        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.add-user-account-form');
    }
}
