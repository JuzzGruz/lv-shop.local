<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            'user_id' => User::get()->random()->id,
            'name' => fake()->word(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'amount' => 100,
            'status' => 0
        ];
    }

    //создает вместе с пользователем
    public function makeAll(): static
    {
        $user = User::factory()->create();
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
