<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name"=> "Artificial Grass Carpets",
            ],
            [
                "name"=> "Wall to Wall Carpets",
            ],
            [
                "name"=> "Curtain Rods & Rails",
            ],
            [
                "name"=> "Wall Decor",
            ],
            [
                "name"=> "Artificial Flowers",
            ],
            [
                "name"=> "Office Blinds",
            ],
            [
                "name"=> "PVC Antislip mats",
            ]
        ];

        Category::insert($categories);
    }
}
