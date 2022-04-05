<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subcategory;
use App\Models\Brand;
use Livewire\Component;

class CreateBrand extends Component
{
    public $subcategories, $brands, $brand;
 
    public $brandForm = [
        'subcategory_id' => '',
        'name' => null,
    ];

    public $brandEdit = [
        'open' => false,
        'subcategory_id' => '',
        'name' => null,
    ];

    protected $validationAttributes = [
        'brandForm.subcategory_id' => 'Subcategoría',
        'brandForm.name' => 'Nombre',
        'brandEdit.name' => 'Nombre',
        'brandEdit.subcategory_id' => 'Subcategoría',
    ];

    protected $listeners = ['deleteBrand'];

    public function mount(){
        $this->brands = Brand::all();
        $this->subcategories = Subcategory::all();
    }

    public function saveBrand()
    {
        $this->validate([
            'brandForm.subcategory_id' => 'required',
            'brandForm.name' => 'required',
        ]);

        Brand::create([
            'name' => $this->brandForm['name'],
            'subcategory_id' => $this->brandForm['subcategory_id'],
        ]);

        $this->reset('brandForm');
        $this->emit('brand_guardado');
        $this->brands = Brand::all();
    }

    public function editBrand(Brand $brand)
    {
        $this->brand = $brand;

        $this->resetValidation();

        $this->brandEdit['name'] = $brand->name;
        $this->brandEdit['subcategory_id'] = $brand->subcategory_id;
        $this->brandEdit['open'] = true;
    }

    public function updateBrand()
    {
        $rules = [
            'brandEdit.subcategory_id' => 'required',
            'brandEdit.name' => 'required',
        ];

        $this->validate($rules);

        $this->brand->update($this->brandEdit);
        $this->reset('brandEdit');

        $this->brands = Brand::all();
    }

    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
        $this->brands = Brand::all();
    }

    public function render()
    {
        return view('livewire.admin.create-brand')->layout('layouts.admin');
    }
}
