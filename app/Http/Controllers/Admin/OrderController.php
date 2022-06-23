<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
    /**
     * Перегляд списка заказів
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
        $statuses = Order::STATUSES;
        return view('admin.order.index',compact('orders', 'statuses'));
    }

    /**
     * Перегляд окремого заказа
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.show', compact('order', 'statuses'));
    }

    /**
     * Форма редагування заказа
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    /**
     * Обновляеє заказ покупця
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order) {
        $order->update($request->all());
        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', 'Замовлення успішно оновленно');
    }
}
