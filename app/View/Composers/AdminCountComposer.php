<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminCountComposer
{
    public function compose(View $view)
    {
        $count = [
            'products' => Product::count(),
            'brands' => Brand::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'pages' => Page::count()
        ];
        $view->with('count', $count);
    }
}
