<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategory extends Component
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

    public function render(): Factory|View|Application
    {
        //        $products = Product::where('category_id', $this->identificador)->paginate(10);
        $products_query = Product::query()->whereHas('category', function (Builder $query) {
            $query->where('category_id', $this->identificador);
        });
        if ($this->marca != 'todas') {
            $this->resetPage();
            $products_query = $products_query->whereHas('brand', function (Builder $query) {
                $query->where('name', $this->marca);
            });
        }
        $products = $products_query->paginate(10);
        return view('livewire.show-category', compact('products'));
    }
}
