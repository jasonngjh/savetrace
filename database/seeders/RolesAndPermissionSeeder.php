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

        $adminRole = Role::create(['name' => 'system admin']);
        $internalDocRole = Role::create(['name' => 'internal']);
        $externalDocRole = Role::create(['name' => 'external']);
        $employeeRole = Role::create(['name' => 'nurse']);
        Role::create(['name' => 'patient']);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@savetrace.com',
            'password' => Hash::make('password'),
            'contact_number' => '98738321',
        ]);

        $admin->assignRole($adminRole);

        $internalDoc = User::factory()->create([
            'name' => 'internal doctor',
            'email' => 'internalDoc@savetrace.com',
            'password' => Hash::make('password'),
            'contact_number' => '88732321',
            'role_id' => 1,
        ]);

        $internalDoc->assignRole($internalDocRole);

        $externalDoc = User::factory()->create([
            'name' => 'external doctor',
            'email' => 'externalDoc@externalclinic.com',
            'password' => Hash::make('password'),
            'contact_number' => '88732321',
            'role_id' => 3,
        ]);

        $externalDoc->assignRole($externalDocRole);

        $employee = User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@savetrace.com',
            'password' => Hash::make('password'),
            'contact_number' => '98458321',
        ]);

        $employee->assignRole($employeeRole);
    }
}
