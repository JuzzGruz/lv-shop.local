<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin.category.index page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/category');

    $response->assertOk();
});

test('admin.category.create page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/category/create');

    $response->assertOk();
});

test('category is saved in the database', function () {
    $user = User::factory()->admin()->create();

    //создаем фейковые данные
    $file = UploadedFile::fake()->image('img.jpg');
    $data = [
        'name' => '123',
        'image' => $file
    ];

    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->post('/admin/category', $data);
    
    $response->assertRedirect(route('admin.category.index'));

    //получаем созданную категорию
    $category = Category::first();
    //проверка что категория с таким именем создана в БД
    $this->assertEquals($data['name'], $category->name);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/category/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/category/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/category/' . $file->hashName());
});

test('admin.category.edit page is displayed', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/category/' . $category->slug . '/edit');

    $response->assertOk();
});

test('category edited and save', function () {
    $user = User::factory()->admin()->create();

    //создаем категорию в БД
    $category = Category::factory()->image()->create();
    //вносим изменения
    $file = UploadedFile::fake()->image('img.jpg');
    $data = [
        'name' => 'Edited',
        'slug' => 'edited',
        'image' => $file
    ];
    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->patch('/admin/category/' . $category->slug, $data);
    
    $response->assertRedirect(route('admin.category.index'));

    //получаем измененную категорию
    $category = Category::first();
    //проверка что категория с изменёнными данными
    $this->assertEquals($data['name'], $category->name);
    //в базе сохранение идет без первого знака слеш "/"
    $this->assertEquals('img/category/' . $file->hashName(), $category->image);
    $this->assertEquals($data['slug'], $category->slug);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/category/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/category/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/category/' . $file->hashName());
});

test('admin.category.show page is displayed', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/category/' . $category->slug);

    $response->assertOk();
});

test('category is deleted along with the image', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->image()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/admin/category/' . $category->slug);

    $response->assertRedirect(route('admin.category.index'));
    //проверка что данных не осталось как в БД так и на диске
    $this->assertDatabaseCount('categories', 0);
    Storage::disk('public')->assertMissing('/img/category/' . $category->image);
});
