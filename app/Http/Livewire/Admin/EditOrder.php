<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ciudad;
use App\Models\Order;
use App\Models\Provincia;
use Livewire\Component;

class EditOrder extends Component
{
    public $order;
    public $cliente;
    public $ciudades = [];
    public $provincias = [];
    public $url;
    public $provincia_id;
    public $listaProductos = [];

    public $orderEdit = [
        'id' => 0,
        'coste_envio' => 0,
        'total' => 0,
        'content' => 0,
        'address' => '',
        'observaciones' => '',
        'tipo_recogida' => 0,
        'status' => 0,
        'user_id' => 0,
        'ciudad_id' => 0,
        'provincia_id' => 0
    ];

    protected $validationAttributes = [
        'orderEdit.coste_envio' => 'Coste envío',
        'orderEdit.total' => 'Importe total',
        'orderEdit.tipo_recogida' => 'Tipo de recogida',
        'orderEdit.status' => 'Status',
        'orderEdit.user_id' => 'Cliente',
        'orderEdit.address' => 'Dirección',
        'orderEdit.ciudad_id' => 'Ciudad',
        'provincia_id' => 'Provincia'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->url = url()->previous();
        $envio = json_decode($this->order->envio);

        $this->orderEdit['id'] = $this->order->id;
        $this->orderEdit['coste_envio'] = $this->order->coste_envio;
        $this->orderEdit['total'] = $this->order->total;
        $this->orderEdit['content'] = $this->order->content;
        $this->orderEdit['address'] = $envio->address;
        $this->orderEdit['observaciones'] = $this->order->observaciones;
        $this->orderEdit['tipo_recogida'] = $this->order->tipo_recogida;
        $this->orderEdit['status'] = $this->order->status;
        $this->orderEdit['user_id'] = $this->order->user->id;

        $this->provincia_id = ($envio->provincia != '') ? Provincia::where('name', $envio->provincia)->first()->id : '';
        $this->orderEdit['provincia_id'] = $this->provincia_id;
        $this->cliente = $this->order->user->name;
        $this->orderEdit['ciudad_id'] = ($envio->ciudad != '') ? Ciudad::where('provincia_id', $this->provincia_id)->where('name', $envio->ciudad)->first()->id : '';

        $this->provincias = Provincia::all();
        $this->ciudades = Ciudad::where('provincia_id', $this->orderEdit['provincia_id'])->get();
    }

    public function updatedProvinciaId()
    {
        $this->orderEdit['provincia_id'] = $this->provincia_id;
        $this->orderEdit['ciudad_id'] = '';
        $this->ciudades = Ciudad::where('provincia_id', $this->orderEdit['provincia_id'])->get();
    }

    public function updateOrder()
    {
        if ($this->orderEdit['tipo_recogida'] == '2') {
            if ($this->orderEdit['coste_envio'] == 0) {
                $this->orderEdit['coste_envio'] = 3.99;
                $this->orderEdit['total'] = $this->orderEdit['total']  + $this->orderEdit['coste_envio'];
            }
        } else {
            if ($this->orderEdit['coste_envio'] != 0) {
                $this->orderEdit['total'] = $this->orderEdit['total']  -  $this->orderEdit['coste_envio'];
                $this->orderEdit['coste_envio'] = 0;
            }

            $this->orderEdit['address'] = '';
            $this->orderEdit['ciudad_id'] = null;
            $this->orderEdit['provincia_id'] = null;
        }


        if ($this->orderEdit['tipo_recogida'] == '2') {
            $rules = [
                'orderEdit.coste_envio' => 'required',
                'orderEdit.total' => 'required',
                'orderEdit.tipo_recogida' => 'required',
                'orderEdit.status' => 'required',
                'orderEdit.user_id' => 'required',
                'orderEdit.address' => 'required',
                'orderEdit.ciudad_id' => 'required',
                'provincia_id' => 'required'
            ];
        } else {
            $rules = [
                'orderEdit.total' => 'required',
                'orderEdit.tipo_recogida' => 'required',
                'orderEdit.status' => 'required',
                'orderEdit.user_id' => 'required',
            ];
        }

        $this->validate($rules);
        $envio = [
            'ciudad' => ($this->orderEdit['ciudad_id'] != '') ? Ciudad::where('provincia_id', $this->orderEdit['provincia_id'])->where('id', $this->orderEdit['ciudad_id'])->first()->name : '',
            'provincia' => ($this->orderEdit['provincia_id'] != '') ? Provincia::find($this->orderEdit['provincia_id'])->name : '',
            'address' => $this->orderEdit['address']
        ];
        $envio = json_encode($envio);

        $this->order->update([
            'coste_envio' => $this->orderEdit['coste_envio'],
            'total' => $this->orderEdit['total'],
            'observaciones' => $this->orderEdit['observaciones'],
            'tipo_recogida' => $this->orderEdit['tipo_recogida'],
            'status' => $this->orderEdit['status'],
            'user_id' => $this->orderEdit['user_id'],
            'envio' => $envio

        ]);

        $this->reset('orderEdit');

        $this->redirect($this->url);
    }

    public function render()
    {
        $items = json_decode($this->order->content);
        return view('livewire.admin.edit-order', compact('items'))->layout('layouts.admin');
    }
}
