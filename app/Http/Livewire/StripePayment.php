<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class StripePayment extends Component
{
    public Order $order;

    protected $listeners = ['paymentMethod', 'paypalSuccess'];


    public function paymentMethod($paymentId)
    {
        $payment = auth()->user()->charge($this->order->total * 100, $paymentId);
        if ($payment->status == 'succeeded') {
            $this->order->status = Order::PAGADO;
            $this->order->save();

            $items = json_decode($this->order->content);
            foreach ($items as $item) {
                $product = Product::find($item->id);
                $product->stock = $product->stock - $item->quantity;
                $product->save();
            }

            return redirect()->route('aPersonal');
        }
    }

    public function paypalSuccess()
    {
        $this->order->status = Order::PAGADO;
        $this->order->save();

        $items = json_decode($this->order->content);
        foreach ($items as $item) {
            $product = Product::find($item->id);
            $product->stock = $product->stock - $item->quantity;
            $product->save();
        }

        return redirect()->route('aPersonal');
    }


    public function render()
    {
        return view('livewire.stripe-payment');
    }
}
