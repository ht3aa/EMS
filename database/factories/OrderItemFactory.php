<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(), // Create an order if not provided
            'product_id' => Product::factory(), // Create a product if not provided
            'quantity' => $this->faker->numberBetween(1, 5), // Quantity between 1 and 5
            'price' => $this->faker->randomFloat(2, 10, 100), // Price between 10 and 100
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
