<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Provincia;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('categories');
        Storage::makeDirectory('categories');

        Storage::deleteDirectory('subcategories');
        Storage::makeDirectory('subcategories');

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);

        $this->call(SubcategorySeeder::class);

        Subcategory::all()->each(function (Subcategory $subcategory) {
            Brand::factory(5)->create([
                'subcategory_id' => $subcategory->id
            ]);
        });


        Product::factory(250)->create()->each(function (Product $product) {
            for ($i = 0; $i < 4; $i++) {
                Image::create([
                    'product_id' => $product->id,
                    'url' => 'products/' . saveRandomImage('public/storage/products/' . $product->id . $i . '.jpeg', $product->id . $i . '.jpeg')
                ]);
            }
        });

        $this->call(ProvinciaSeeder::class);

        $this->call(UserSeeder::class);
    }
}
