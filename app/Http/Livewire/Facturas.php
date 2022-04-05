<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Facturas extends Component
{
    public $orders;

    protected $listeners = ['render'];

    public function render()
    {
        $this->orders = Order::where('user_id', auth()->user()->id)->orderby('id', 'desc')->get();
        return view('livewire.facturas');
    }
}
