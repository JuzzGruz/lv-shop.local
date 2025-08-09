<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->realText(10);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'content' => fake()->realText(rand(150, 200)),
            'parent_id' => 0
        ];
    }

    //создает вместе с родителем
    public function children(): static
    {
        $page = Page::factory()->create();
        return $this->state(fn (array $attributes) => [
            'parent_id' => $page->id,
        ]);
    }
}
