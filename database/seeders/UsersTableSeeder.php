<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the users table.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create an author user
        User::create([
            'uuid' => 'uuid',
            'name' => 'Author',
            'username' => 'author',
            'email' => 'author@author.com',
            'password' => Hash::make('12345'),
            'role' => 'author',
            'status' => 'active',
        ]);

        // Create 10 regular users using the factory
        User::factory()->count(10)->create();
    }
}
