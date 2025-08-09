<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\User\OrderProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\IndexController as UserIndexController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::group([
    'as' => 'user.',
    'predix' => 'user',
    'middleware' => ['auth', 'verified']
],function () {
    //Личный кабинет
    Route::get('/personal-cabinet', UserIndexController::class)->name('index');
    //Профиль пользователя
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Просмотр списка заказов в личном кабинете
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    //Просмотр отдельного заказа в личном кабинете
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    //Профили заказов пользователя
    Route::resource('orderProfile', OrderProfileController::class);
});

Route::group(['namespace' => 'App/Http/Controller/Catalog', 'prefix' => 'catalog'], function() {
    Route::get('/index', [CatalogController::class,'index'])->name('catalog.index');
    Route::get('/search', [CatalogController::class,'search'])->name('catalog.search');
    Route::get('/category/{category:slug}', [CatalogController::class,'category'])->name('catalog.category');
    Route::get('/brand/{brand:slug}', [CatalogController::class,'brand'])->name('catalog.brand');
    Route::get('/product/{product:slug}', [CatalogController::class,'product'])->name('catalog.product');
});

Route::group(['prefix' => 'basket'], function (){
    Route::get('/index', [BasketController::class, 'index'])->name('basket.index');
    Route::get('/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    Route::post('/add/{id}', [BasketController::class, 'add'])->where('id', '[0-9]+')->name('basket.add');
    Route::post('/plus/{id}', [BasketController::class, 'plus'])->where('id', '[0-9]+')->name('basket.plus');
    Route::post('/minus/{id}', [BasketController::class, 'minus'])->where('id', '[0-9]+')->name('basket.minus');
    Route::post('/remove/{id}', [BasketController::class, 'remove'])->where('id', '[0-9]+')->name('basket.remove');
    Route::post('/clear', [BasketController::class, 'clear'])->name('basket.clear');
    Route::post('/saveorder', [BasketController::class, 'save_order'])->name('basket.saveorder');
    Route::get('/success', [BasketController::class, 'success'])->name('basket.success');
});

Route::get('page/{page:slug}', PageController::class)->name('page.show');

require __DIR__.'/admin.php';
