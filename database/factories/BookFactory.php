<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\User;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'author_id' => function () {
                return User::factory()->create()->id;
            },
            'description' => $this->faker->paragraph(),
            'cover' => $this->faker->imageUrl(60, 60),
            'content' => $this->faker->text(),
            'status' => $this->faker->randomElement(['complete', 'incomplete']),
            'remember_token' => Str::random(20),
        ];
    }
}
