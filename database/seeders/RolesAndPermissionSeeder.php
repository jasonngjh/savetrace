<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
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

        $adminRole = Role::create(['name' => 'SystemAdmin']);
        Role::create(['name' => 'internal']);
        Role::create(['name' => 'external']);
        Role::create(['name' => 'nurse']);
        Role::create(['name' => 'patient']);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@savetrace.app',
            'password' => Hash::make('password'),
            'contact_number' => '98738321',
        ]);

        $admin->assignRole($adminRole);
    }
}
