<?php

namespace Database\Seeders;

use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variations = [
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '10mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '20mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '25mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '30mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '35mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '40mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '50mm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'color_shade',
                'type' => 'color',
                'value' => 'blue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'color_shade',
                'type' => 'color',
                'value' => 'red',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'color_shade',
                'type' => 'color',
                'value' => 'green',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'origin',
                'type' => 'origin',
                'value' => 'locally fabricated',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'origin',
                'type' => 'origin',
                'value' => 'imported',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'durability',
                'type' => 'structure',
                'value' => 'bendable',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'durability',
                'type' => 'structure',
                'value' => 'truck',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'durability',
                'type' => 'structure',
                'value' => 'double',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'other',
                'type' => 'other',
                'value' => 'other',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Variation::insert($variations);

    }
}
