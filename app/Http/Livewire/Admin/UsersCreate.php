<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UsersCreate extends Component
{
    public $name, $email, $password;

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Email',
        'password' => 'Password'
    ];

    public function save()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $this->validate($rules);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        return redirect()->route('admin.users');
    }
    public function render()
    {
        return view('livewire.admin.users-create')->layout('layouts.admin');
    }
}
