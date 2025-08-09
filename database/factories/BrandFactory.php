<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();
        return [
            'name' => $name,
            'content' => fake()->realText(rand(150, 200)),
            'slug' => Str::slug($name),
        ];
    }

    /**
     * добавляет картинку
     */
    public function image(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => function () : string
            {
                $file = UploadedFile::fake()->image('img.jpg');
                $img = Storage::disk('public')->put('/img/brand', $file);
                return $img;
            },
        ]);
    }
}
