<?php

namespace Database\Seeders;

use App\Models\Coauthorbook;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoauthorbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all author users
        $authors = User::where('role', 'author')->get();

        // Loop through each author and create coauthorbooks
        foreach ($authors as $author) {
            for ($i = 1; $i <= 10; $i++) {
                $coauthorbook = Coauthorbook::factory()->create([
                    'author_id' => $author->id,
                    'title' => 'Coauthorbook ' . $i,
                    'description' => 'Description of Coauthorbook ' . $i,
                    'status' => 'incomplete',
                ]);

                // Add additional authors to coauthorbook
                $additionalAuthors = $authors->except([$author->id]);
                $coauthorbook->authors()->attach($additionalAuthors->random(rand(1, 5))->pluck('id'), [
                    'coauthorbooks_author' => $author->id,
                ]);
            }
        }
    }
}
