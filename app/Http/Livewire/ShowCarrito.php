<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowCarrito extends Component
{

    public $cartContent;

    public function mount()
    {
        if (CartFacade::getContent()) {
            $this->cartContent = CartFacade::getContent();
        }
    }

    public function masCant($id)
    {
        $cartItem = CartFacade::get($id);

        if ($cartItem->quantity < $cartItem->attributes->stock) {
            CartFacade::update($id, array(
                'quantity' => +1,
            ));
        } else {

            $this->dispatchBrowserEvent("banner-message", [
                "style" => "danger",
                "message" => __("Stock máximo disponible del producto.."),
            ]);
        }

        $this->emit('render');
        $this->cartContent = CartFacade::getContent();
    }

    public function menosCant($id)
    {
        $cartItem = CartFacade::get($id);

        if ($cartItem->quantity > 1) {
            CartFacade::update($id, array(
                'quantity' => -1,
            ));
        } else {
            CartFacade::remove($id);
        }

        $this->emit('render');
        $this->cartContent = CartFacade::getContent();
    }

    public function removeItem($id)
    {
        CartFacade::remove($id);
        $this->emit('render');
        $this->cartContent = CartFacade::getContent();
    }

    public function clear()
    {

        CartFacade::clear();
        $this->cartContent = CartFacade::getContent();
        $this->emit('render');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.show-carrito');
    }
}
