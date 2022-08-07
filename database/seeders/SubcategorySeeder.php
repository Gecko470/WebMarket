<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubcategorySeeder extends Seeder
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
                'name' => 'Televisión',
                'category_id' => 1,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/television.jpeg', 'television.jpeg'),
                'icon' => '<i class="fa-solid fa-tv"></i>'

            ],
            [
                'name' => 'Vídeo',
                'category_id' => 1,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/video.jpeg', 'video.jpeg'),
                'icon' => '<i class="fa-solid fa-video"></i>'
            ],
            [
                'name' => 'Fotografía',
                'category_id' => 1,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/fotografia.jpeg', 'fotografia.jpeg'),
                'icon' => '<i class="fa-solid fa-camera"></i>'
            ],
            [
                'name' => 'Reproductores',
                'category_id' => 2,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/reproductores.jpeg', 'reproductores.jpeg'),
                'icon' => '<i class="fa-solid fa-play"></i>'
            ],
            [
                'name' => 'Auriculares',
                'category_id' => 2,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/auriculares.jpeg', 'auriculares.jpeg'),
                'icon' => '<i class="fa-solid fa-headphones"></i>'
            ],
            [
                'name' => 'Telefonía móvil',
                'category_id' => 3,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/telefoniamovil.jpeg', 'telefoniamovil.jpeg'),
                'icon' => '<i class="fa-solid fa-mobile-screen-button"></i>'
            ],
            [
                'name' => 'Telefonía fija',
                'category_id' => 3,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/telefoniafija.jpeg', 'telefoniafija.jpeg'),
                'icon' => '<i class="fa-solid fa-phone"></i>'
            ],
            [
                'name' => 'XBox',
                'category_id' => 4,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/xbox.jpeg', 'xbox.jpeg'),
                'icon' => '<i class="fa-brands fa-xbox"></i>'
            ],
            [
                'name' => 'PlayStation',
                'category_id' => 4,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/playstation.jpeg', 'playstation.jpeg'),
                'icon' => '<i class="fa-brands fa-playstation"></i>'
            ],
            [
                'name' => 'Steam',
                'category_id' => 4,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/steam.jpeg', 'steam.jpeg'),
                'icon' => '<i class="fa-brands fa-steam-square"></i>'
            ],
            [
                'name' => 'Portátiles',
                'category_id' => 5,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/portatiles.jpeg', 'portatiles.jpeg'),
                'icon' => '<i class="fa-solid fa-laptop"></i>'
            ],
            [
                'name' => 'Sobremesa',
                'category_id' => 5,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/sobremesa.jpeg', 'sobremesa.jpeg'),
                'icon' => '<i class="fa-solid fa-desktop"></i>'
            ],
            [
                'name' => 'Componentes',
                'category_id' => 5,
                'img' => 'subcategories/' . saveRandomImage('public/storage/subcategories/componentes.jpeg', 'componentes.jpeg'),
                'icon' => '<i class="fa-solid fa-computer-mouse"></i>'
            ]
        ];

        Subcategory::insert($datos);
    }
}
