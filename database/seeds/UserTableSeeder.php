<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'User';
        $user->email = 'visitor@example.com';
        $user->password = bcrypt('visitor');
        $user->save();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();

        $manager = new User();
        $manager->name = 'Manager';
        $manager->email = 'author@example.com';
        $manager->password = bcrypt('author');
        $manager->save();
        
    }
}
