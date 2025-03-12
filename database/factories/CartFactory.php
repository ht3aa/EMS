<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
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
            'product_id' => Product::factory(), // Create a product if not provided
            'quantity' => $this->faker->numberBetween(1, 5), // Quantity between 1 and 5
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
