<?php

namespace Database\Seeders;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Featured Products',
                'description' => 'featured products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Latest Products',
                'description' => 'latest products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Discounted Products',
                'description' => 'discounted products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Tag::insert($tags);
    }
}
