<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::create([
            'name'      => 'user', 
            'password'  => Hash::make('P4$$w0rd'), 
            'role'      => 'User',
            'email'     => 'user@gmail.com', 
            'no_hp'     => '08999'
        ]);
    }
}
