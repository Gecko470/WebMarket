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
            Image::factory(4)->create([
                'product_id' => $product->id
            ]);
        });

        $this->call(ProvinciaSeeder::class);
    }
}
