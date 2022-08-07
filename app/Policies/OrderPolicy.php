<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function author(User $user, Order $order)
    {
        if ($user->id == $order->user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function payment(User $user, Order $order)
    {
        if ($order->status == 0) {
            return true;
        } else {
            return false;
        }
    }
}
