<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datos = [
            [
                'name' => 'Imagen, TV y Vídeo',
                'img' => 'categories/' . saveRandomImage('public/storage/categories/imagen.jpeg', 'imagen.jpeg'),
                'icon' => '<i class="fa-solid fa-tv"></i>'
            ],
            [
                'name' => 'Sonido',
                'img' => 'categories/' . saveRandomImage('public/storage/categories/sonido.jpeg', 'sonido.jpeg'),
                'icon' => '<i class="fa-solid fa-music"></i>'
            ],
            [
                'name' => 'Telefonía',
                'img' => 'categories/' . saveRandomImage('public/storage/categories/telefonia.jpeg', 'telefonia.jpeg'),
                'icon' => '<i class="fa-solid fa-mobile-screen-button"></i>'
            ],
            [
                'name' => 'Videojuegos',
                'img' => 'categories/' . saveRandomImage('public/storage/categories/videojuegos.jpeg', 'videojuegos.jpeg'),
                'icon' => '<i class="fa-solid fa-gamepad"></i>'
            ],
            [
                'name' => 'Informática',
                'img' => 'categories/' . saveRandomImage('public/storage/categories/informatica.jpeg', 'informatica.jpeg'),
                'icon' => '<i class="fa-solid fa-desktop"></i>'
            ]
        ];

        Category::insert($datos);
    }
}
