<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $pendingOrders = Order::where('user_id', auth()->user()->id)->where('status', '0')->get()->count();
            if ($pendingOrders > 0) {
                $msj = "Visite su <a class= 'font-bold underline' href='" . route('aPersonal') . "'>Área Personal</a>, tiene pedidos pendientes..";
                session()->flash('flash.banner', $msj);
            }
        }

        return view('welcome');
    }

    public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    public function carrito()
    {
        return view('carrito');
    }

    public function showcategory($id)
    {
        return view('showcategory', compact('id'));
    }

    public function showsubcategory($id)
    {
        return view('showsubcategory', compact('id'));
    }
}
