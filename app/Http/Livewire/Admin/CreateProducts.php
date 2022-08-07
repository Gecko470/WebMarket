<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CreateProducts extends Component
{
    public $categories, $subcategories = [], $brands = [], $category_id = '', $subcategory_id = '', $brand_id = '';
    public $product, $name, $description, $price, $stock, $url;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'brand_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required | numeric',
        'stock' => 'required | numeric',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function volver()
    {
        return redirect()->route('admin.index');
    }

    public function updatedCategoryId()
    {
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        $this->reset('subcategory_id');
    }

    public function updatedSubcategoryId()
    {
        $this->brands = Brand::where('subcategory_id', $this->subcategory_id)->get();
        $this->reset('brand_id');
    }

    public function save()
    {
        $this->validate();

        $this->product = new Product();

        $this->product->category_id = $this->category_id;
        $this->product->subcategory_id = $this->subcategory_id;
        $this->product->brand_id = $this->brand_id;
        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->price = $this->price;
        $this->product->stock = $this->stock;

        $this->product->save();

        return redirect()->route('admin.products.edit', $this->product);
    }

    public function render()
    {
        return view('livewire.admin.create-products')->layout('layouts.admin');
    }
}
