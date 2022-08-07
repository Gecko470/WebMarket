<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowInformatica extends Component
{
    public $products = [];

    public function load()
    {
        $products = Product::where('category_id', 5)->take(28)->get();
        $this->products = $products;
        $this->emit('slider');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.show-informatica');
    }
}
