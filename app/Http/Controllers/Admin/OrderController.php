<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Controllers\Admin\Order\DeleteAction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('status', 'asc')->paginate(5);
        $status = Order::STATUS;
        return view('admin.order.index',compact('orders', 'status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $status = Order::STATUS;
        return view('admin.order.show', compact('order', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $status = Order::STATUS;
        return view('admin.order.edit', compact('order', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()
            ->route('admin.order.show', $order->id)
            ->with('success', 'Заказ был успешно обновлен');
    }

    public function destroy(Order $order, DeleteAction $action) : RedirectResponse
    {
        if ($order->status > 1) {
            return back()->withErrors('Отменить можно только новый или обработанный заказ');
        }
        $prodQuantity = $action($order);
        return redirect()
            ->route('admin.order.index')
            ->with(compact('prodQuantity'));
    }
}
