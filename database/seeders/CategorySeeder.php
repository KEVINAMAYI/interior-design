<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
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
                "name" => "Artificial Grass Carpets",
                'description' => 'artificial grass carpets',
                'slug' => 'grass_carpet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                "name" => "Wall to Wall Carpets",
                'description' => 'wall to wall carpets',
                'slug' => 'wall_carpet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Curtain Rods & Rails",
                'description' => 'curtain rods & rails',
                'slug' => 'curtain_rods',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Wall Decor",
                'description' => 'wall decor',
                'slug' => 'wall_decor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Artificial Flowers",
                'description' => 'artificial flowers',
                'slug' => 'artificial_flowers',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Office Blinds",
                'description' => 'office blinds',
                'slug' => 'office_blinds',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "PVC Antislip mats",
                'description' => 'pvc antislip mats',
                'slug' => 'anti_slip_mats',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Category::insert($categories);
    }
}
