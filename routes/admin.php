<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImgController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
        'as' => 'admin.',
        'namespace' => 'App\Http\Controllers\Admin', 
        'prefix' => 'admin',
        'middleware' => ['auth', 'verified', 'admin']
    ], function (){

    Route::get('/', IndexController::class)->name('index');

    // CRUD-операции над категории
    Route::group([
        'prefix' => 'category'
    ], function (){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/{category:slug}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // CRUD-операции над брендами
    Route::group([
        'prefix' => 'brand'
    ], function (){
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/{brand:slug}', [BrandController::class, 'show'])->name('brand.show');
        Route::get('/{brand:slug}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::patch('/{brand:slug}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/{brand:slug}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });
    
    // CRUD-операции над товарами
    Route::group([
        'prefix' => 'product'
    ], function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{product:slug}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/{product:slug}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{product:slug}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Операции с заказами
    Route::resource('order', OrderController::class,
    ['except' => [
        'create', 'store'
    ]]);
    // Операции с пользователями
    Route::resource('user', UserController::class,
    ['except' => [
        'create', 'store'
    ]]);
    // Операции с страницами
    Route::resource('page', PageController::class);
    Route::get('/img', [ImgController::class, 'getAllImg'])->name('image.index');
    Route::post('/img', [ImgController::class, 'upload'])->name('image.upload');
    Route::delete('/img', [ImgController::class, 'delete'])->name('image.delete');
});

require __DIR__.'/auth.php';
