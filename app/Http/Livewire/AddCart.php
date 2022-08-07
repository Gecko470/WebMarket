<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade;
use Storage;

class AddCart extends Component
{

    public $cant = 1;
    public $product, $image;

    public function mount()
    {
        $this->image = Storage::url($this->product->images->first()->url);
    }

    public function masCant()
    {
        $this->cant++;
    }

    public function menosCant()
    {
        $this->cant--;
    }

    public function addCartItem($id)
    {
        CartFacade::add(
            array(
                'id' => $this->product->id,
                'name' => $this->product->name,
                'price' => $this->product->price,
                'quantity' => $this->cant,
                'attributes' => array(
                    'img' => $this->image,
                    'stock' => $this->product->stock,
                )
            ),
        );

        $cartItem = CartFacade::get($id);

        if ($cartItem) {

            if ($cartItem->quantity > $cartItem->attributes->stock) {
                CartFacade::update($id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $cartItem->attributes->stock
                    ),
                ));

                $this->dispatchBrowserEvent("banner-message", [
                    "style" => "danger",
                    "message" => __("Producto agregado al carrito, cantidad máxima disponible en stock.."),
                ]);
            } else {
                $this->dispatchBrowserEvent("banner-message", [
                    "style" => "success",
                    "message" => __("Producto agregado al carrito.."),
                ]);
            }
        }

        $this->emit('render');
        $this->reset('cant');
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
