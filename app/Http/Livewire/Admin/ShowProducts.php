<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $termino;
    protected $listeners = ['delete'];

    public function updatedTermino()
    {
        $this->resetPage();
    }

    public function delete(Product $product)
    {
        $product->delete();
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->termino . '%')->paginate(10);
        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }
}
