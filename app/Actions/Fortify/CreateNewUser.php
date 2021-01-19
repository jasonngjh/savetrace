<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements
    CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        if (!array_key_exists('role', $input)) {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'contact_number' => ['numeric'],
                'password' => $this->passwordRules(),
                'dob' => ['date', 'before:today'],
                'address' => ['required', 'string'],
            ])->validate();
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'contact_number' => ['numeric'],
                'password' => $this->passwordRules(),
            ])->validate();
        }

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'contact_number' => $input['contact_number'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $user->assignRole('patient');
                if (!array_key_exists('role', $input)) {
                    $this->createPatient($user, $input);
                }
                //$this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }

    /**
     * Create a patient for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createPatient(User $user, $input)
    {
        $dob = date_format(date_create_from_format('d-m-Y', $input['dob']), 'Y-m-d');
        $patient = Patient::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'date_of_birth' => $dob,
            'contact_number' => $user->contact_number,
            'address' => $input['address'],
        ]);

        $patient->save();

        $user->forceFill([
            'role_id' => $patient->id,
        ])->save();
    }
}
