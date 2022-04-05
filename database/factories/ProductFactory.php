<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_id = Category::all()->random(1)->first()->id;
        $subcategory_id = Subcategory::where('category_id', $category_id)->get()->random(1)->first()->id;
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(500),
            'price' => rand(50, 1500),
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'brand_id' => Brand::where('subcategory_id', $subcategory_id)->get()->random(1)->first()->id,
            'stock' => rand(3, 40)
        ];
    }
}
