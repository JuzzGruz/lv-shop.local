<?php

use App\Models\brand;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin.brand.index page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/brand');

    $response->assertOk();
});

test('admin.brand.create page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/brand/create');

    $response->assertOk();
});

test('brand is saved in the database', function () {
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
        ->post('/admin/brand', $data);
    
    $response->assertRedirect(route('admin.brand.index'));

    //получаем созданный бренд
    $brand = Brand::first();
    //проверка что бренд с таким именем создана в БД
    $this->assertEquals($data['name'], $brand->name);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/brand/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/brand/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/brand/' . $file->hashName());
});

test('admin.brand.edit page is displayed', function () {
    $user = User::factory()->admin()->create();
    $brand = Brand::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/brand/' . $brand->slug . '/edit');

    $response->assertOk();
});

test('brand edited and save', function () {
    $user = User::factory()->admin()->create();

    //создаем бренд в БД
    $brand = Brand::factory()->image()->create();
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
        ->patch('/admin/brand/' . $brand->slug, $data);
    
    $response->assertRedirect(route('admin.brand.index'));

    //получаем измененный бренд
    $brand = Brand::first();
    //проверка что категория с изменёнными данными
    $this->assertEquals($data['name'], $brand->name);
    //в базе сохранение идет без первого знака слеш "/"
    $this->assertEquals('img/brand/' . $file->hashName(), $brand->image);
    $this->assertEquals($data['slug'], $brand->slug);

    //проверка на существование катринки
    Storage::disk('public')->assertExists('/img/brand/' . $file->hashName());
    //удаление картинки и проверка на ее отсутствие
    Storage::disk('public')->delete('/img/brand/' . $file->hashName());
    Storage::disk('public')->assertMissing('/img/brand/' . $file->hashName());
});

test('admin.brand.show page is displayed', function () {
    $user = User::factory()->admin()->create();
    $brand = Brand::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/brand/' . $brand->slug);

    $response->assertOk();
});

test('brand is deleted along with the image', function () {
    $user = User::factory()->admin()->create();
    $brand = Brand::factory()->image()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/admin/brand/' . $brand->slug);

    $response->assertRedirect(route('admin.brand.index'));
    //проверка что данных не осталось как в БД так и на диске
    $this->assertDatabaseCount('brands', 0);
    Storage::disk('public')->assertMissing('/img/brand/' . $brand->image);
});
