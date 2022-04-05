<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $datos = [
            [
                'name' => 'Imagen, TV y Vídeo',
                'img' => 'categories/' . $faker->image('public/storage/categories', 640, 480, null, false),
                'icon' => '<i class="fa-solid fa-tv"></i>'
            ],
            [
                'name' => 'Sonido',
                'img' => 'categories/' . $faker->image('public/storage/categories', 640, 480, null, false),
                'icon' => '<i class="fa-solid fa-music"></i>'
            ],
            [
                'name' => 'Telefonía',
                'img' => 'categories/' . $faker->image('public/storage/categories', 640, 480, null, false),
                'icon' => '<i class="fa-solid fa-mobile-screen-button"></i>'
            ],
            [
                'name' => 'Videojuegos',
                'img' => 'categories/' . $faker->image('public/storage/categories', 640, 480, null, false),
                'icon' => '<i class="fa-solid fa-gamepad"></i>'
            ],
            [
                'name' => 'Informática',
                'img' => 'categories/' . $faker->image('public/storage/categories', 640, 480, null, false),
                'icon' => '<i class="fa-solid fa-desktop"></i>'
            ]
        ];

        Category::insert($datos);
    }
}
