<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{

    public $product, $route;

    public function mount()
    {
        $this->route = url()->previous();
    }

    public function volver()
    {
        return redirect($this->route);
    }

    public function render()
    {
        return view('livewire.show-product');
    }
}
