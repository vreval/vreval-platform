<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marker>
 */
class MarkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'position_x' => fake()->randomFloat(),
            'position_y' => fake()->randomFloat(),
            'position_z' => fake()->randomFloat(),
            'rotation_x' => fake()->randomFloat(),
            'rotation_y' => fake()->randomFloat(),
            'rotation_z' => fake()->randomFloat(),
        ];
    }
}
