<?php

namespace App\Http\Livewire;

use App\Models\Ciudad;
use App\Models\Order;
use App\Models\Provincia;
use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;

class OrderCreate extends Component
{
    public $cartContent, $provincias, $ciudades = [];
    public $provincia_id = '', $ciudad_id = '';
    public $coste_envio = 0, $tipo_recogida = 1;
    public $address, $observaciones;

    protected $rules = [
        'tipo_recogida' => 'required'
    ];

    public function mount()
    {
        $this->cartContent = CartFacade::getContent();
        $this->provincias = Provincia::all();
    }

    public function updatedProvinciaId()
    {
        $this->ciudades = Ciudad::where('provincia_id', $this->provincia_id)->get();
        $this->coste_envio = Provincia::find($this->provincia_id)->coste_envio;
        $this->reset('ciudad_id');
    }

    public function updatedTipoRecogida($value)
    {
        if ($value == 1) {
            $this->resetValidation();
            $this->reset(['provincia_id', 'ciudad_id', 'coste_envio']);
        }
    }

    public function create_order()
    {
        if ($this->provincia_id == '') {
            $this->provincia_id = null;
        }
        if ($this->ciudad_id == '') {
            $this->ciudad_id = null;
        }

        $rules = $this->rules;
        if ($this->tipo_recogida == 2) {
            $rules['provincia_id'] = 'required';
            $rules['ciudad_id'] = 'required';
            $rules['address'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();

        $order->coste_envio = $this->coste_envio;
        $order->total = CartFacade::getTotal() + $this->coste_envio;
        $order->content = CartFacade::getContent();
        /* $order->address = $this->address; */
        $order->observaciones = $this->observaciones;
        $order->tipo_recogida = $this->tipo_recogida;
        $order->status = Order::PENDIENTE;
        $order->user_id = auth()->user()->id;
        /* $order->ciudad_id = $this->ciudad_id;
        $order->provincia_id = $this->provincia_id; */
        if ($this->tipo_recogida == 2) {
            $order->envio = [
                'address' => $this->address,
                'ciudad' => Ciudad::find($this->ciudad_id)->name,
                'provincia' => Provincia::find($this->provincia_id)->name
            ];
        } else {
            $order->envio = [
                'address' => '',
                'ciudad' => '',
                'provincia' => ''
            ];
        }

        $order->envio = json_encode($order->envio);

        $order->save();

        CartFacade::clear();

        return redirect()->route('order.payment', $order);
    }

    public function render()
    {
        return view('livewire.order-create');
    }
}
