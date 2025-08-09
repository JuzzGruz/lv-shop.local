<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Главная страница каталога
     */
    public function index()
    {
        // корневые категории
        $roots = Category::where('parent_id', 0)->get();
        // популярные бренды
        $brands = Brand::popular();
        return view('catalog.index', compact('roots', 'brands'));
    }

    public function search(Request $request) : View {
        $search = $request->input('query');
        $query = Product::search($search);
        $result = $query->paginate(6)->withQueryString();
        return view('catalog.index', compact('result'));
    }
    /**
     * Страница категории
     */
    public function category(Category $category)
    {
        // получаем всех потомков этой категории
        $descendants = $category->get_all_children($category->id);
        // товары этой категории и всех потомков
        $products = Product::whereIn('category_id', $descendants)->paginate(6);
        return view('catalog.category', compact('category', 'products'));
    }

    /**
     * Страница Бренда
     */
    public function brand(Brand $brand)
    {
        $products = $brand->products()->paginate(6);
        return view('catalog.brand', compact('brand', 'products'));
    }

    /**
     * Страница Продукта
     */
    public function product(Product $product)
    {
        return view('catalog.product', compact('product'));
    }
}

