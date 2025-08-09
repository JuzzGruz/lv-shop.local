<?php

namespace App\Actions\Controllers\Basket;

class ChangeAction
{
    /**
     * Изменяет кол-во товара $product_id на величину $count
     */
    public function __invoke($basket, $product_id, $count = 0)
    {
        // если товар есть в корзине — изменяем кол-во
        if ($basket->products->contains('id', $product_id)) {
            $pivotRow = $basket->products()->where('product_id', $product_id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем кол-во товара $product_id в корзине
                $pivotRow->update(['quantity' => $quantity]);
                // обновляем поле `updated_at` таблицы `baskets`
                $basket->touch();
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
                $basket->touch();
            }
        }
    }
}