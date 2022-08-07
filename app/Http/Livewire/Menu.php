<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Menu extends Component
{
    public $open = false;

    public function open(){
        $this->open = !$this->open;
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.menu', compact('categories'));
    }
}
