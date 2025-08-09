<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
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
        $prod = Product::get()->random();
        $quantity = rand(1, 5);
        return [
            'order_id' => Order::get()->random()->id,
            'product_id' => $prod->id,
            'name' => $prod->name,
            'price' => $prod->price,
            'quantity' => $quantity,
            'cost' => $prod->price * $quantity
        ];
    }

    //создает все необходимое
    public function makeAll(): static
    {
        $order = Order::factory()->create();
        $product = Product::factory()->makeAll()->create();
        return $this->state(fn (array $attributes) => [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'cost' => $product->price,
            'quantity' => 1,
        ]);
    }
}
