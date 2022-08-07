<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Juan Gómez',
            'email' => 'codeworks9@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');
    }
}
