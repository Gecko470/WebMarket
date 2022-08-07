<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreateSubcategory extends Component
{
    use WithFileUploads;

    public $categories, $subcategories, $idAleatorio, $idAleatEdit, $subcategory, $imgSubcatEdit;

    public $subcategoryForm = [
        'category_id' => '',
        'name' => null,
        'icon' => null,
        'image' => null,
    ];

    public $subcategoryEdit = [
        'open' => false,
        'category_id' => '',
        'name' => null,
        'icon' => null,
        'image' => null,
    ];

    public $brandForm = [
        'subcategory_id' => '',
        'name' => null,
    ];

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'subcategoryForm.category_id' => 'Categoría',
        'subcategoryForm.name' => 'Nombre',
        'subcategoryForm.icon' => 'Icono',
        'subcategoryForm.image' => 'Imagen',
        'brandForm.subcategory_id' => 'Subcategoría',
        'brandForm.name' => 'Nombre',
        'subcategoryEdit.category_id' => 'Categoría',
        'subcategoryEdit.name' => 'Nombre',
        'subcategoryEdit.icon' => 'Icono',
        'imgSubcatEdit' => 'Imagen',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
        $this->idAleatorio = rand();
    }

    public function saveSubcategory()
    {
        $this->validate([
            'subcategoryForm.category_id' => 'required',
            'subcategoryForm.name' => 'required',
            'subcategoryForm.icon' => 'required',
            'subcategoryForm.image' => 'required|image|max:1024',
        ]);

        $img = $this->subcategoryForm['image']->store('subcategories');

        Subcategory::create([
            'name' => $this->subcategoryForm['name'],
            'icon' => $this->subcategoryForm['icon'],
            'img' => $img,
            'category_id' => $this->subcategoryForm['category_id'],
        ]);

        $this->idAleatorio = rand();
        $this->reset('subcategoryForm');
        $this->emit('subcat_guardado');
        $this->subcategories = Subcategory::all();
    }

    public function edit(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;

        $this->reset('imgSubcatEdit');
        $this->resetValidation();

        $this->subcategoryEdit['name'] = $subcategory->name;
        $this->subcategoryEdit['icon'] = $subcategory->icon;
        $this->subcategoryEdit['image'] = $subcategory->img;
        $this->subcategoryEdit['category_id'] = $subcategory->category_id;
        $this->subcategoryEdit['open'] = true;
    }

    public function update()
    {
        $rules = [
            'subcategoryEdit.category_id' => 'required',
            'subcategoryEdit.name' => 'required',
            'subcategoryEdit.icon' => 'required',
        ];

        if ($this->imgSubcatEdit) {
            $rules['imgSubcatEdit'] = 'image|max:1024';
        }
        $this->validate($rules);

        if ($this->imgSubcatEdit) {
            Storage::delete($this->subcategoryEdit['image']);
            $this->subcategoryEdit['image'] = $this->imgSubcatEdit->store('subcategories');
        }

        $this->subcategory->update([
            'name' => $this->subcategoryEdit['name'],
            'icon' => $this->subcategoryEdit['icon'],
            'img' => $this->subcategoryEdit['image'],
            'category_id' => $this->subcategoryEdit['category_id'],
        ]);

        $this->reset('imgSubcatEdit', 'subcategoryEdit');

        $this->subcategories = Subcategory::all();
    }

    public function delete(Subcategory $subcategory)
    {
        $subcategory->delete();
        $this->subcategories = Subcategory::all();
    }

    public function saveBrand()
    {
        $validatedData = $this->validate([
            'brandForm.subcategory_id' => 'required',
            'brandForm.name' => 'required',
        ]);

        Brand::create([
            'name' => $this->brandForm['name'],
            'subcategory_id' => $this->brandForm['subcategory_id'],
        ]);

        $this->reset('brandForm');
        $this->emit('brand_guardado');
    }

    public function render()
    {
        return view('livewire.admin.create-subcategory')->layout('layouts.admin');
    }
}
