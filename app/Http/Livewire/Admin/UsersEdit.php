<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use FontLib\Table\Type\name;
use Livewire\Component;

class UsersEdit extends Component
{
    public $name, $email, $password, $nuevoPassword, $user;

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Email',
        'nuevoPassword' => 'Nuevo Password'
    ];

    public function mount(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function update()
    {
        if ($this->nuevoPassword != '') {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'nuevoPassword' => 'min:8'
            ];
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email'
            ];
        }

        $this->validate($rules);

        if ($this->nuevoPassword != '') {
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->nuevoPassword)
            ]);
        } else {
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
        }


        $this->user->save();

        return redirect()->route('admin.users');
    }

    public function assignRole($value)
    {
        if ($value == "1") {
            $this->user->removeRole('admin');
        } else if ($value == "0") {
            $this->user->assignRole('admin');
        }
    }


    public function render()
    {
        return view('livewire.admin.users-edit')->layout('layouts.admin');
    }
}
