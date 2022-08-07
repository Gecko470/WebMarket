<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ciudad;
use App\Models\Provincia;
use Livewire\Component;

class EditProvincia extends Component
{
    public $ciudades, $ciudad, $provincia, $url;

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'ciudadForm.name' => 'Nombre',
        'ciudadEdit.name' => 'Nombre'
    ];

    public $ciudadForm = [
        'name' => ''
    ];

    public $ciudadEdit = [
        'open' => false,
        'name' => ''
    ];

    public function mount(Provincia $provincia)
    {
        $this->provincia = $provincia;
        $this->ciudades = Ciudad::where('provincia_id', $provincia->id)->get();
        $this->url = url()->previous();
    }

    public function edit(Ciudad $ciudad)
    {
        $this->ciudad = $ciudad;

        $this->ciudadEdit['name'] = $ciudad->name;

        $this->ciudadEdit['open'] = true;
    }

    public function saveCiudad()
    {
        $this->validate([
            'ciudadForm.name' => 'required'
        ]);

        $this->provincia->ciudades()->create([
            'name' => $this->ciudadForm['name']
        ]);

        $this->reset('ciudadForm');
        $this->emit('ciudad_guardado');
        $this->ciudades = Ciudad::where('provincia_id', $this->provincia->id)->get();
    }

    public function update()
    {
        $rules = [
            'ciudadEdit.name' => 'required'
        ];

        $this->validate($rules);

        $this->ciudad->update([
            'name' => $this->ciudadEdit['name']
        ]);

        $this->reset('ciudadEdit');

        $this->ciudades = Ciudad::where('provincia_id', $this->provincia->id)->get();
    }

    public function delete(Ciudad $ciudad)
    {
        $ciudad->delete();
        $this->ciudades = Ciudad::where('provincia_id', $this->provincia->id)->get();
    }


    public function render()
    {
        return view('livewire.admin.edit-provincia')->layout('layouts.admin');
    }
}
