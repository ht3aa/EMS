<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // Create a user if not provided
            'cart_id' => $this->CartFactory(), // Total amount between 50 and 500
            'status' => $this->faker->randomElement([0, 1, 2]), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
