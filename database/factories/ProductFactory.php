<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word, // Unique product name
            'description' => $this->faker->sentence, // Random description
            'price' => $this->faker->randomFloat(2, 10, 1000), // Price between 10 and 1000
            'stock' => $this->faker->numberBetween(0, 100), // Stock between 0 and 100
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
