<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Controllers\Admin\Product\DeleteAction;
use App\Actions\Controllers\Admin\Product\StoreAction;
use App\Actions\Controllers\Admin\Product\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    //Главная страница
    public function index() : View
    {
        $products = Product::paginate(10);

        return view('admin.product.index', compact('products'));
    }

    //Страница товара
    public function show(Product $product) : View
    {
        return view('admin.product.show', compact('product'));
    }

    //Страница создания
    public function create()  : View
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    //Сохранение в базу
    public function store(ProductStoreRequest $request, StoreAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $product = $action($data);

        return redirect()
            ->route('admin.product.show', $product->slug)
            ->with('success', 'Новый товар успешно создан');
    }

    //Страница редактирования
    public function edit(Product $product) : View
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    //Обновление данных в базе
    public function update(ProductUpdateRequest $request, Product $product, UpdateAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $action($product, $data);

        return redirect()
            ->route('admin.product.show', $product->slug)
            ->with('success', "Товар $product->name был успешно обновлен");
    }

    //Удаление из базы
    public function destroy(Product $product, DeleteAction $action) : RedirectResponse
    {
        $name = $action($product);

        return redirect()
            ->route('admin.product.index')
            ->with('success', "Товар $name удалён");
    }
}
