<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cookie;

class Basket extends Model
{
    protected $withCount = ['products'];

    public static function get_basket()
    {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $basket = self::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = self::create();
            }
        } else {
            $basket = self::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);
        return $basket;
    }
    
    // общая цена корзины
    public function get_amount() : float
    {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }
    
    //проверка количества товаров для сохранения заказа
    public function check_products($products) : array
    {
        $errors = [];
        foreach ($products as $product) {
            if ($product->amount < $product->pivot->quantity) {
                $errors[] = $product->name;
            }
        }
        return $errors;
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'basket_product', 'basket_id', 'product_id', 'id', 'id')->withPivot('quantity');
    }
}
