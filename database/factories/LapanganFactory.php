<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lapangan>
 */
class LapanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no' => $this->faker->unique()->numberBetween(1,1000),
            'price' => $this->faker->numberBetween(1000,1000000),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
        ];
    }
}
