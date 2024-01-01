<?php

namespace Database\Factories;

use App\Models\Coauthorbook;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoauthorbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coauthorbook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => function () {
                return User::factory()->create()->id;
            },
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'cover' => $this->faker->imageUrl(60, 60),
            'content' => $this->faker->text(),
            'status' => $this->faker->randomElement(['complete', 'incomplete']),
        ];
    }
}
