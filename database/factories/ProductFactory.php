<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $name = fake()->realText(rand(40, 50));
        return [
            'category_id' => Category::get()->random()->id,
            'brand_id' => Brand::get()->random()->id,
            'name' => $name,
            'content' => fake()->realText(rand(400, 500)),
            'slug' => Str::slug($name),
            'price' => rand(1000, 2000),
            'amount' => rand(10, 200),
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
                $img = Storage::disk('public')->put('/img/product', $file);
                return $img;
            },
        ]);
    }

    //создает продукт вместе с брендом и категорией
    public function makeAll(): static
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        return $this->state(fn (array $attributes) => [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);
    }
}
