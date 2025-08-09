<?php

use App\Models\User;

test('admin.index page is displayed for administrator', function () {
    $user = User::factory()->admin()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin');

    $response->assertOk();
});

test('guests cannot access administration pages', function () {
    $response = $this->get('/admin');

    $response->assertRedirect();
});

test('user cannot access administration pages', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin');

    $response->assertStatus(404);
});
