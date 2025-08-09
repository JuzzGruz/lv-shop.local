<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin.product.index page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/product');

    $response->assertOk();
});

test('admin.product.create page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/product/create');

    $response->assertOk();
});

test('product is saved in the database', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();
    $brand = Brand::factory()->create();
    //создаем фейковые данные
    $file = UploadedFile::fake()->image('img.jpg');
    $data = [
        'name' => '123ass',
        'slug' => '123ass',
        'category_id' => $category->id,
        'brand_id' => $brand->id,
        'price' => '111',
        'image' => $file
    ];

    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->post('/admin/product', $data);
    
    $response->assertRedirect(route('admin.product.show', $data['slug']));

    //получаем созданную категорию
    $product = Product::first();
    //проверка что категория с таким именем создана в БД
    $this->assertEquals($data['name'], $product->name);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/product/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/product/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/product/' . $file->hashName());
});

test('admin.product.edit page is displayed', function () {
    $user = User::factory()->admin()->create();
    Category::factory()->create();
    Brand::factory()->create();
    $product = Product::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/product/' . $product->slug . '/edit');

    $response->assertOk();
});

test('product edited and save', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();
    $brand = Brand::factory()->create();
    //создаем категорию в БД
    $product = Product::factory()->image()->create();
    //вносим изменения
    $file = UploadedFile::fake()->image('img.jpg');
    $data = [
        'name' => 'Edited',
        'category_id' => $category->id,
        'brand_id' => $brand->id,
        'price' => 11.11,
        'slug' => 'edited',
        'image' => $file
    ];
    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->patch('/admin/product/' . $product->slug, $data);
    
    $response->assertRedirect(route('admin.product.show', 'edited'));

    //получаем измененную категорию
    $product = Product::first();
    //проверка что категория с изменёнными данными
    $this->assertEquals($data['name'], $product->name);
    //в базе сохранение идет без первого знака слеш "/"
    $this->assertEquals('img/product/' . $file->hashName(), $product->image);
    $this->assertEquals($data['slug'], $product->slug);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/product/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/product/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/product/' . $file->hashName());
});

test('admin.product.show page is displayed', function () {
    $user = User::factory()->admin()->create();
    Category::factory()->create();
    Brand::factory()->create();
    $product = Product::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/product/' . $product->slug);

    $response->assertOk();
});

test('product is deleted along with the image', function () {
    $user = User::factory()->admin()->create();
    Category::factory()->create();
    Brand::factory()->create();
    $product = Product::factory()->image()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/admin/product/' . $product->slug);

    $response->assertRedirect(route('admin.product.index'));
    //проверка что данных не осталось как в БД так и на диске
    $this->assertDatabaseCount('products', 0);
    Storage::disk('public')->assertMissing('/img/product/' . $product->image);
});
