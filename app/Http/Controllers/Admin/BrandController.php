<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Controllers\Admin\Brand\DeleteAction;
use App\Actions\Controllers\Admin\Brand\StoreAction;
use App\Actions\Controllers\Admin\Brand\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandStoreRequest;
use App\Http\Requests\Admin\Brand\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandController extends Controller
{

    //Главная страница
    public function index() : View
    {
        $brands = Brand::paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    //Страница создания
    public function create() : View
    {
        return view('admin.brand.create');
    }

    //Сохранение в базу
    public function store(BrandStoreRequest $request, StoreAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $brand = $action($data);

        return redirect()
            ->route('admin.brand.index')
            ->with('success', "Бренд $brand->name создан");
    }

    //Показ бренда
    function show(Brand $brand) : View
    {
        return view('admin.brand.show', compact('brand'));
    }

    //Страница редактирования
    public function edit(Brand $brand) : View
    {
        return view('admin.brand.edit', compact('brand'));
    }

    //Обновление данных в базе
    public function update(BrandUpdateRequest $request, Brand $brand, UpdateAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $action($data, $brand);

        return redirect()
            ->route('admin.brand.index')
            ->with('success', "Бренд $brand->name отредактирован");
    }

    //Удаление из базы
    public function destroy(Brand $brand, DeleteAction $action) : RedirectResponse
    {
        $name = $action($brand);

        return redirect()
            ->route('admin.brand.index')
            ->with('success', "Бренд $name Удалён");
    }
    
}
