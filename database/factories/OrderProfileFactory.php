<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderProfileFactory extends Factory
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
            'title' => fake()->realText(10),
            'name' => fake()->realText(10),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'comment' => fake()->realText(50)
        ];
    }

    //содает вместе с пользователем
    public function user(): static
    {
        $user = User::factory()->create();
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
