<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipies>
 */
class RecipiesFactory extends Factory
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
            'image' => rand(0,1) ? $this->faker->imageUrl() : null,
            'ingredients' => $this->faker->text(),
            'instructions' => $this->faker->text(),
            'category' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner', 'snack']),
        ];
    }
}
