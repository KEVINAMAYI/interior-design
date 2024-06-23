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
            ]
        ];

        Variation::insert($variations);

    }
}
