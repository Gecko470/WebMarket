<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IconoCarrito extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.icono-carrito');
    }
}
