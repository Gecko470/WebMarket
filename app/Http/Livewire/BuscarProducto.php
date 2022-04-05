<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class BuscarProducto extends Component
{
    public $termino;
    public $products = [];
    public $open = false;

    public function updatedTermino($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function render()
    {
        if ($this->termino) {
            $this->products = Product::where('name', 'like', '%' . $this->termino . '%')->take(10)->get();
        } else {
            $this->products = [];
        }
        return view('livewire.buscar-producto', ['products' => $this->products]);
    }
}
