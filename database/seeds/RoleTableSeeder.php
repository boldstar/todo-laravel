<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->role = 'User';
        $role_user->save();
        
        $role_manager = new Role();
        $role_manager->role = 'Manager';
        $role_manager->save();

        $role_admin = new Role();
        $role_admin->role = 'Admin';
        $role_admin->save();
    }
}    