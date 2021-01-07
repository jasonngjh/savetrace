<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions 
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        //Permission::create(['name' => '']);

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        Role::create(['name' => 'patient']);

        $superAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@savetrace.com',
            'password' => Hash::make('password'),
            'contact_number' => '98738321',
        ]);

        $superAdmin->ownedTeams()->save(Team::forceCreate([
            'user_id' => $superAdmin->id,
            'name' => explode(' ', $superAdmin->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));

        $superAdmin->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@savetrace.com',
            'password' => Hash::make('password'),
            'contact_number' => '88732321',
        ]);

        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));

        $user->assignRole($userRole);
    }
}
