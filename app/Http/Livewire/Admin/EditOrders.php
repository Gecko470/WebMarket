<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ciudad;
use App\Models\Order;
use App\Models\Provincia;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class EditOrders extends Component
{
    use WithPagination;


    public $statusF = '';
    public $recogidaF = '';
    public $pedidoF;
    public $clienteF = '';
    public $provinciaF = '';
    public $ciudadF = '';

    protected $listeners = ['delete'];

    public function delete(Order $order)
    {
        $order->delete();
    }

    public function borrar()
    {
        $this->reset();
    }

    public function render(): Factory | View | Application
    {
        $orders_query = Order::query()->whereHas('user', function (Builder $query) {
            $query->where('name', 'like', '%' . $this->clienteF . '%');
        });

        if ($this->statusF != '') {
            $orders_query = $orders_query->where('status', $this->statusF);
        }
        if ($this->recogidaF != '') {
            $orders_query = $orders_query->where('tipo_recogida', $this->recogidaF);
        }
        if ($this->pedidoF != '') {
            $orders_query = $orders_query->where('id', 'like', $this->pedidoF);
        }

        $orders = $orders_query->paginate(10);


        return view('livewire.admin.edit-orders', compact('orders'))->layout('layouts.admin');
    }
}
