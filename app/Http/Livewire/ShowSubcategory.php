<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSubcategory extends Component
{
    use WithPagination;

    public $identificador;
    public $marca = 'todas';
    public $grid = true;
    public $readyToLoad = false;

    public function load()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $products_query = Product::query()->whereHas('subcategory', function (Builder $query) {
            $query->where('id', $this->identificador);
        });
        if ($this->marca != 'todas') {
            $this->resetPage();
            $products_query = $products_query->whereHas('brand', function (Builder $query) {
                $query->where('name', $this->marca);
            });
        }
        $products = $products_query->paginate(10);
        return view('livewire.show-subcategory', compact('products'));
    }
}
