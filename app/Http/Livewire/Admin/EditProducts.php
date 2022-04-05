<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditProducts extends Component
{
    public $product;
    public $categories, $subcategories = [], $brands = [], $category_id = '', $subcategory_id = '', $brand_id = '';
    public $name, $description, $price, $stock, $url;


    protected $listeners = ['refreshEdit'];

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'brand_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required | numeric',
        'stock' => 'required | numeric',
    ];

    public function mount(Product $product)
    {
        $this->url = url()->previous();

        $this->product = $product;
        $this->categories = Category::all();
        $this->category_id = $product->category->id;
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        $this->subcategory_id = $product->subcategory_id;
        $this->brands = Brand::where('subcategory_id', $this->subcategory_id)->get();
        $this->brand_id = $product->brand_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
    }

    public function volver()
    {
        return redirect($this->url);
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

        $this->product->category_id = $this->category_id;
        $this->product->subcategory_id = $this->subcategory_id;
        $this->product->brand_id = $this->brand_id;
        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->price = $this->price;
        $this->product->stock = $this->stock;

        $this->product->save();

        $this->emit('actualizado');
    }

    public function deleteImg(Image $image)
    {
        Storage::delete($image->url);
        $image->delete();

        $this->product = $this->product->fresh();
    }

    public function refreshEdit()
    {
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        return view('livewire.admin.edit-products')->layout('layouts.admin');
    }
}
