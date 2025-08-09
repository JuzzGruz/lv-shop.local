<?php

namespace App\Actions\Controllers\Admin\Order;

use App\Models\Order;
use App\Models\Product;

final class DeleteAction
{
    public function __invoke(Order $order) : array
    {
        $prodQuantity = [];
        foreach ($order->items as $item) {
            Product::where('id', $item->product_id)->increment('amount', $item->quantity);
            $prodQuantity[$item->name] = $item->quantity;
        }
        $order->delete();

        return $prodQuantity;
    }
}
