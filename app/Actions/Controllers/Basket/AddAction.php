<?php

namespace App\Actions\Controllers\Basket;

class AddAction
{
    public function __invoke($basket, $id, $quantity) : int
    {
        if ($basket->products->contains('id', $id)) {
            // если такой товар есть в корзине — изменяем кол-во
            $pivotRow = $basket->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $quantity;
            $pivotRow->update(['quantity' => $quantity]);
            $int = 0;
        } else {
           $basket->products()->attach($id, ['quantity' => $quantity]);
           $int = 1;
        }
        $basket->touch();
        return $int;
    }
}