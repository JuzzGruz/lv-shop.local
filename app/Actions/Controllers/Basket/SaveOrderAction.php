<?php

namespace App\Actions\Controllers\Basket;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class SaveOrderAction
{
    public function __invoke($basket, $request) : Model
    {
        // сохраняем введенные данные в сессии для удобста пользователя
        $request->session()->put('old_order_value', [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'comment' => $request->comment
        ]);
        // сохраняем заказ
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
        $request->all() + ['amount' => $basket->get_amount(), 'user_id' => $user_id]
        );

        foreach ($basket->products as $product) {
            $product->amount -= $product->pivot->quantity;
            $product->update();
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }

        // уничтожаем корзину
        $basket->delete();
        Cookie::expire('basket_id');

        return $order;
    }
}