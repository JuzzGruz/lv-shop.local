<?php

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderProfile;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;

test('basket relation OK', function () {

    $basket = Basket::create();
    Category::factory()->create();
    Brand::factory()->create();
    $prod = Product::factory()->count(2)->create();
    $basket->products()->attach($prod, ['quantity' => '1']);
    //проверка отношения belongsToMany модели Basket по отношению к модели Product
    $this->assertEquals($basket->products[0]->id, $prod[0]->id);
});

test('brand relation OK', function () {

    Category::factory()->create();
    $brand = Brand::factory()->create();
    $prod = Product::factory()->create();
    $prod = $prod->id;
    $brand = $brand->products[0]->id;
    //проверка отношения hasMany модели Brand по отношению к модели Product
    $this->assertEquals($brand, $prod);
});

test('category relation OK', function () {

    $category = Category::factory()->create();
    Category::factory()->state(['parent_id' => $category->id])->create();
    Brand::factory()->create();
    $prod = Product::factory()->state(['category_id' => $category->id])->create();
    //проверка отношения hasMany модели Category по отношению к модели Product
    $this->assertEquals($category->products[0]->id, $prod->id);
    //проверка отношения hasMany модели Category по отношению к себе
    $this->assertEquals($category->children[0]->parent_id, $category->id);
});

test('order and order_item relation OK', function () {
    
    $users = User::factory()->count(2)->create();
    Brand::factory()->create();
    Category::factory()->create();
    $product = Product::factory()->create();
    //метод for использует отношение belongTo в модели
    $order = Order::factory()
        ->for($users[0])
        ->create();
    $orderItem = OrderItem::factory()->create();

    //проверка отношения belongTo модели Order по отношению к модели User
    $this->assertEquals($order->user->id, $users[0]->id);
    //проверка отношения hasMany модели Order по отношению к модели OrderItem
    $this->assertEquals($order->items[0]->order_id, $order->id);
    //проверка отношения belongTo модели OrderItems по отношению к модели Product
    $this->assertEquals($orderItem->product->id, $product->id);
    //проверка отношения belongTo модели OrderItems по отношению к модели Order
    $this->assertEquals($orderItem->order->id, $order->id);
});

test('product relation OK', function () {

    $product = Product::factory()->makeAll()->create();
    $brand = Brand::first();
    $category = Category::first();
    $basket = Basket::create();
    $basket->products()->attach($product, ['quantity' => '1']);
    Order::factory()->makeAll()->create();
    $orderItem = OrderItem::factory()->create();
    //проверка отношения belongTo модели Product к модели Brand
    $this->assertEquals($brand->id, $product->brand->id);
    //проверка отношения belongTo модели Product к модели Category
    $this->assertEquals($category->id, $product->category->id);
    //проверка отношения belongsToMany модели Product к модели Basket
    $this->assertEquals($product->baskets[0]->id, $basket->id);
    //проверка отношения hasMany модели Product к модели OrderItem
    $this->assertEquals($product->order_items[0]->id, $orderItem->id);
});

test('page relation OK', function () {

    $page = Page::factory()->children()->create();
    $parent = Page::where('parent_id', 0)->first();
    //проверка отношения belongTo модели Page по отношению к себе
    $this->assertEquals($page->parent->id, $parent->id);
    //проверка отношения hasMany модели Page по отношению к себе
    $this->assertEquals($page->id, $parent->children[0]->id);
});

test('orderProfile relation OK', function () {

    $orderProfile = OrderProfile::factory()->user()->create();
    $user = User::first();
    //проверка отношения belongTo модели OrderProfile по отношению к модели User
    $this->assertEquals($orderProfile->user->id, $user->id);
});

test('user relation OK', function () {

    $user = User::factory()->create();
    $order = Order::factory()->create();
    $orderProfile = OrderProfile::factory()->create();
    //проверка отношения hasMany модели User по отношению к модели Order
    $this->assertEquals($user->orders[0]->id, $order->id);
    //проверка отношения hasMany модели User по отношению к модели OrderProfile
    $this->assertEquals($user->order_profile[0]->id, $orderProfile->id);
});