<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment(Order $order)
    {
        $this->authorize('author', $order);
        $this->authorize('payment', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);
        return view('order.payment', compact('order', 'items', 'envio'));
    }

    public function aPersonal()
    {
        return view('order.aPersonal');
    }

    public function show(Order $order)
    {
        $this->authorize('author', $order);

        $items = json_decode($order->content);
        return view('order.show', compact('order', 'items'));
    }
}
