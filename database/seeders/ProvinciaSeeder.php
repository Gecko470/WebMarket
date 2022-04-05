<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::factory(54)->create()->each(function (Provincia $provincia) {
            Ciudad::factory(50)->create([
                'provincia_id' => $provincia->id
            ]);
        });
    }
}
