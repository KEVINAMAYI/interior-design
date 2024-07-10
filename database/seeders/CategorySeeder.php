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
                'icon' => 'bi-cast',
                'color' => 'green',
                'image_url' => 'front-end-assets/images/categories/artificial_grass_carpets.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                "name" => "Wall to Wall Carpets",
                'description' => 'wall to wall carpets',
                'slug' => 'wall_carpet',
                'icon' => 'bi-bricks',
                'color' => 'pink',
                'image_url' => 'front-end-assets/images/categories/wall_to_wall_carpets.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Curtain Rods & Rails",
                'description' => 'curtain rods & rails',
                'slug' => 'curtain_rods',
                'icon' => 'bi-film',
                'color' => 'skyblue',
                'image_url' => 'front-end-assets/images/categories/curtain_rods_and_rails.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Wall Decor",
                'description' => 'wall decor',
                'slug' => 'wall_decor',
                'icon' => 'bi-border-bottom',
                'color' => 'purple',
                'image_url' => 'front-end-assets/images/categories/wall_decor.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Artificial Flowers",
                'description' => 'artificial flowers',
                'slug' => 'artificial_flowers',
                'icon' => 'bi-flower1',
                'color' => 'yellow',
                'image_url' => 'front-end-assets/images/categories/artificial_flowers.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Office Blinds",
                'description' => 'office blinds',
                'slug' => 'office_blinds',
                'icon' => 'bi-border-width',
                'color' => 'danger',
                'image_url' => 'front-end-assets/images/categories/office_blinds.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "PVC Antislip mats",
                'description' => 'pvc antislip mats',
                'slug' => 'anti_slip_mats',
                'icon' => 'bi-hypnotize',
                'color' => 'dark',
                'image_url' => 'front-end-assets/images/categories/anti_slip_mats.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Category::insert($categories);
    }
}
