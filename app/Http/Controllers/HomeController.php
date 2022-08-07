<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function valoraciones(Request $request, Product $product)
    {

        $request->validate([
            'comment' => 'required|min:20',
            'ratio' => 'required|numeric|min:1|max:5'
        ]);

        $product->valoraciones()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'ratio' => $request->ratio
        ]);

        session()->flash('flash.banner', 'Se ha registrado tu valoración..');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }
}
