<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Variation extends Seeder
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
                'value' => '10mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '20mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '25mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '30mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '35mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '40mm'
            ],
            [
                'name' => 'height',
                'type' => 'measurements',
                'value' => '50mm'
            ]
        ];
    }
}
