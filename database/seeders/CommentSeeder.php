<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Coauthorbook;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Ensure there are users and coauthorbooks available
        if (User::count() === 0 || Coauthorbook::count() === 0) {
            $this->command->warn('Users or Coauthorbooks not found. Skipping CommentSeeder.');
            return;
        }

        Comment::factory()->count(50)->create();
    }
}


