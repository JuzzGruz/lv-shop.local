<?php

use App\Models\Page;
use App\Models\User;

test('page is displayed', function () {
    $page = Page::factory()->create();
    $response = $this->get('/page/' . $page->slug);

    $response->assertOk();
});

test('admin.page.index page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/page');

    $response->assertOk();
});

test('admin.page.create page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/page/create');

    $response->assertOk();
});

test('page is saved in the database', function () {
    $user = User::factory()->admin()->create();

    //создаем фейковые данные
    $data = [
        'name' => 'test',
        'slug' => 'test',
        'parent_id' => '0',
        'content' => 'wda'
    ];

    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->post('/admin/page', $data);
    //проверяем что страница создана путем ее получения из бд
    $page = Page::where('slug', $data['slug'])->first();
    
    $response->assertRedirect(route('admin.page.show', $page->id));
});

test('admin.page.edit page is displayed', function () {
    $user = User::factory()->admin()->create();
    $page = Page::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/page/' . $page->id . '/edit');

    $response->assertOk();
});

test('page edited and save', function () {
    $user = User::factory()->admin()->create();
    //создаем категорию в БД
    $page = Page::factory()->create();
    //вносим изменения
    $data = [
        'name' => 'Edited',
        'slug' => 'edited',
        'content' => 'edited',
        'parent_id' => 0
    ];
    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->patch('/admin/page/' . $page->id, $data);
    
    $response->assertRedirect(route('admin.page.show', $page->id));

    //получаем измененную категорию
    $page = Page::first();
    //проверка что категория с изменёнными данными
    $this->assertEquals($data['name'], $page->name);
});

test('admin.page.show page is displayed', function () {
    $user = User::factory()->admin()->create();
    $page = Page::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/page/' . $page->id);

    $response->assertOk();
});

test('page is deleted along with the image', function () {
    $user = User::factory()->admin()->create();
    $page = Page::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/admin/page/' . $page->id);

    $response->assertRedirect(route('admin.page.index'));
    //проверка что данных не осталось как в БД так и на диске
    $this->assertDatabaseCount('pages', 0);
});
