<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Brian Allison',
            'email' => 'brially@gmail.com',
            'password' => bcrypt('password'),
        ]);
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'TestUser@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
