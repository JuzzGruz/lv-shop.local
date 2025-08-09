<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::whereUserId(auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $status = Order::STATUS;
        return view('user.order.index', compact('orders', 'status'));
    }

    public function show(Order $order) {
        if (auth()->user()->id !== $order->user_id) {
            abort(404);
        }
        $status = Order::STATUS;
        return view('user.order.show', compact('order', 'status'));
    }
}
