<?php

use Illuminate\Database\Seeder;
use App\Todo;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todo = new Todo();
        $todo->user_id = 1;
        $todo->todo = 'Do The Dishes';
        $todo->complete = false;
        $todo->save();

        $todo = new Todo();
        $todo->user_id = 1;
        $todo->todo = 'Make Money';
        $todo->complete = false;
        $todo->save();

        $todo = new Todo();
        $todo->user_id = 1;
        $todo->todo = 'Help Others';
        $todo->complete = false;
        $todo->save();

        $todo = new Todo();
        $todo->user_id = 2;
        $todo->todo = 'Set This Weeks Goals';
        $todo->complete = false;
        $todo->save();
        
        $todo = new Todo();
        $todo->user_id = 2;
        $todo->todo = 'Wash The Dishes';
        $todo->complete = false;
        $todo->save();

        $todo = new Todo();
        $todo->user_id = 2;
        $todo->todo = 'Fold Laundry';
        $todo->complete = false;
        $todo->save();

        $todo = new Todo();
        $todo->user_id = 3;
        $todo->todo = 'Win At Life';
        $todo->complete = false;
        $todo->save();
    }
}
