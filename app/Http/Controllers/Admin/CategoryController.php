<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Controllers\Admin\Category\DeleteAction;
use App\Actions\Controllers\Admin\Category\StoreAction;
use App\Actions\Controllers\Admin\Category\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{

    //Главная страница
    public function index() : View
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    //Страница создания
    public function create() : View
    {
        $parents = Category::roots();
        return view('admin.category.create', compact('parents'));
    }

    //Сохранение в базу
    public function store(CategoryStoreRequest $request, StoreAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $category = $action($data);

        return redirect()
            ->route('admin.category.index')
            ->with('success', "Категория $category->name создана");
    }

    //Показ категории
    function show(Category $category) : View
    {
        return view('admin.category.show', compact('category'));
    }

    //Страница редактирование
    public function edit(Category $category) : View
    {
        $parents = Category::roots();
        return view('admin.category.edit', compact('category', 'parents'));
    }

    //Обновление данных в базе
    public function update(CategoryUpdateRequest $request, Category $category, UpdateAction $action) : RedirectResponse
    {
        $data = $request->validated();

        $action($category, $data);

        return redirect()
            ->route('admin.category.index')
            ->with('success', "Категория $category->name отредактирована");
    }

    //Удаление из базы
    public function destroy(Category $category, DeleteAction $action) : RedirectResponse
    {
        if ($category->children()->count()) {
            return back()->withErrors('Категория не удалена, т.к. имеет потомков, если хотите удалить категорию, сначала удалите потомков');
        }
        $name = $action($category);

        return redirect()
            ->route('admin.category.index')
            ->with('success', "Категория $name Удалена");
    }

}

