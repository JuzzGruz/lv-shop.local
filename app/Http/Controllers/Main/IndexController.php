<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke() : View
    {
        // новые товары
        $new_products = Product::latest()
            ->limit(4)
            ->get();
        // популярные товары
        $top_products = Product::select('products.*')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.*, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.id')
            ->where('amount', '>', 0)
            ->orderByDesc('total_quantity')
            ->limit(4)
            ->get();
        return view('index', compact('top_products', 'new_products'));
    }
}
