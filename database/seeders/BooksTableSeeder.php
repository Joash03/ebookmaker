<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;

class BooksTableSeeder extends Seeder
{
    /**
     * Seed the books table.
     *
     * @return void
     */
    public function run()
    {
        // Get all author users
        $authors = User::where('role', 'author')->get();

        // Loop through each author and create 10 books
        foreach ($authors as $author) {
            $booksData = [];

            for ($i = 1; $i <= 5; $i++) {
                $booksData[] = [
                    'title' => 'Book ' . $i,
                    'description' => 'Description of Book ' . $i,
                    'status' => 'incomplete',
                ];
            }

            $author->books()->createMany($booksData);
        }
    }
}
