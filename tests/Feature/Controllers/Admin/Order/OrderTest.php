<?php

use App\Models\Order;
use App\Models\User;

test('admin.order.index page is displayed', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/order');

    $response->assertOk();
});

test('admin.order.edit page is displayed', function () {
    $user = User::factory()->admin()->create();
    $order = Order::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/order/' . $order->id . '/edit');

    $response->assertOk();
});

test('order edited and save', function () {
    $user = User::factory()->admin()->create();

    //создаем категорию в БД
    $order = Order::factory()->create();
    //вносим изменения
    $data = [
        'name' => 'Edited',
    ];
    //имитируем отправку данных админом на сервер
    $response = $this
        ->actingAs($user)
        ->patch('/admin/order/' . $order->id, $data);
    
    $response->assertRedirect(route('admin.order.show', $order->id));

    //получаем измененную категорию
    $order = Order::first();
    //проверка что категория с изменёнными данными
    $this->assertEquals($data['name'], $order->name);
});

test('admin.order.show page is displayed', function () {
    $user = User::factory()->admin()->create();
    $order = Order::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/order/' . $order->id);

    $response->assertOk();
});

test('order is deleted along with the image', function () {
    $user = User::factory()->admin()->create();
    $order = Order::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/admin/order/' . $order->id);

    $response->assertRedirect(route('admin.order.index'));
    //проверка что данных не осталось как в БД так и на диске
    $this->assertDatabaseCount('orders', 0);
});
