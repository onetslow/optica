<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {

            $orders = Order::with('products', 'user')->get();
        } else {
            $orders = Order::with('products')->where('user_id', auth()->id())->get();
        }
    
        return view('orders.index', compact('orders'));
    }    

    public function show($id)
{

    $order = Order::with('products')->find($id);

    if (!$order) {
        return view('orders.show', ['order' => null, 'total' => 0]);
    }
    if (! Gate::allows('view-order', $order)) {
        return redirect()->route('error')->with('message', 'У вас нет доступа к этому заказу!');
    }
    
    $total = $order->products->reduce(function ($carry, $product) {
        return $carry + ($product->pivot->price * $product->pivot->quantity);
    }, 0);

    return view('orders.show', compact('order', 'total'));
}
}
