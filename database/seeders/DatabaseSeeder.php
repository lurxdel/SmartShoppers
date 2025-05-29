<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@email.com',
            'password' => bcrypt('12345678'),
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);
    }
}
