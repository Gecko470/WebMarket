<?php

namespace App\Http\Livewire\Admin;

use App\Models\Provincia;
use Livewire\Component;

class CreateProvincia extends Component
{
    public $provincias, $provincia;

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'provinciaForm.name' => 'Nombre',
        'provinciaEdit.name' => 'Nombre',
        'provinciaForm.coste_envio' => 'Coste envío',
        'provinciaEdit.coste_envio' => 'Coste envío',
    ];

    public $provinciaForm = [
        'name' => '',
        'coste_envio' => null
    ];

    public $provinciaEdit = [
        'open' => false,
        'name' => '',
        'coste_envio' => null
    ];

    public function mount()
    {
        $this->provincias = Provincia::all();
    }

    public function edit(Provincia $provincia)
    {
        $this->provincia = $provincia;

        $this->provinciaEdit['name'] = $provincia->name;
        $this->provinciaEdit['coste_envio'] = $provincia->coste_envio;

        $this->provinciaEdit['open'] = true;
    }

    public function saveProvincia()
    {
        $this->validate([
            'provinciaForm.name' => 'required',
            'provinciaForm.coste_envio' => 'required|numeric|min:1|max:50'
        ]);

        Provincia::create([
            'name' => $this->provinciaForm['name'],
            'coste_envio' => $this->provinciaForm['coste_envio']
        ]);

        $this->reset('provinciaForm');
        $this->emit('provincia_guardado');
        $this->provincias = Provincia::all();
    }

    public function update()
    {
        $rules = [
            'provinciaEdit.name' => 'required',
            'provinciaEdit.coste_envio' => 'required|numeric|min:1|max:50'
        ];

        $this->validate($rules);

        $this->provincia->update([
            'name' => $this->provinciaEdit['name'],
            'coste_envio' => $this->provinciaEdit['coste_envio']
        ]);

        $this->reset('provinciaEdit');

        $this->provincias = Provincia::all();
    }

    public function delete(Provincia $provincia)
    {
        $provincia->delete();
        $this->provincias = Provincia::all();
    }

    public function render()
    {
        return view('livewire.admin.create-provincia')->layout('layouts.admin');
    }
}
