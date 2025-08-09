<?php

namespace App\View\Composers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use Illuminate\View\View;

class PublicComposer
{
    public function compose(View $view)
    {
        $basket_id = request()->cookie('basket_id');
        $items = [
            'popularBrands' => Brand::popular(),
            'rootCategories' => Category::roots(),
            'pages' => Page::all()
        ];
        if (!empty($basket_id)) {
            $basket = Basket::findOrFail($basket_id);
            $positions = $basket->products_count;
            $view->with('items', $items)
                ->with('positions', $positions);
        } else {
            $view->with('items', $items);
        }
    }
}
