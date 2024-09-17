<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carousel::create([
            'image_url_1' => 'carousel/s_1.png',
            'image_url_2' => 'carousel/s_2.png',
            'image_url_3' => 'carousel/s_3.png',
        ]);
    }
}
