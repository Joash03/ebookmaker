<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Coauthorbook;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => function () {
                return User::factory()->create()->id;
            },
            'coauthorbook_id' => function () {
                return Coauthorbook::factory()->create()->id;
            },
            'content' => $this->faker->paragraph(),
        ];
    }
}
