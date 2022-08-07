<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Valoraciones;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function valoraciones(User $user, Product $product)
    {
        $valoraciones = $product->valoraciones()->where('user_id', auth()->id())->count();
        if ($valoraciones) {
            return false;
        }

        $orders = Order::where('user_id', $user->id)->select('content')->get()->map(function ($order) {
            return json_decode($order->content, true);
        });

        $products = $orders->collapse();

        return $products->contains('id', $product->id);
    }
}
