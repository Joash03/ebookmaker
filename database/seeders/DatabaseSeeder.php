<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed users table
        $this->call(UsersTableSeeder::class);

        // Seed books table
        $this->call(BooksTableSeeder::class);

        // Seed coauthorbooks table
        $this->call(CoauthorbookSeeder::class);

        // Seed comments table
        $this->call(CommentSeeder::class);
    }
}
