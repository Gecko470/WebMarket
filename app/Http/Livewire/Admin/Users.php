<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $usuario = '';
    protected $listeners = ['delete'];

    public function updatedUsuario()
    {
        $this->resetPage();
    }

    public function delete(User $usuario)
    {
        $usuario->delete();
    }


    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->usuario . '%')->orwhere('email', 'like', '%' . $this->usuario . '%')->paginate(10);
        return view('livewire.admin.users', compact('users'))->layout('layouts.admin');
    }
}
