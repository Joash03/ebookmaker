<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Coauthorbook;
use App\Models\Comment;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'author_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'coauthorbook_id' => Coauthorbook::inRandomOrder()->first()->id ?? Coauthorbook::factory(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
