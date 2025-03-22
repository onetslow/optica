<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
{
    // Получаем заказ с товарами
    $order = Order::with('products')->find($id);

    // Если заказа нет, возвращаем view с null
    if (!$order) {
        return view('orders.show', ['order' => null, 'total' => 0]);
    }

    // Подсчитываем итоговую сумму заказа на основе pivot данных
    $total = $order->products->reduce(function ($carry, $product) {
        return $carry + ($product->pivot->price * $product->pivot->quantity);
    }, 0);

    // Передаём в представление заказ и сумму
    return view('orders.show', compact('order', 'total'));
}
}
