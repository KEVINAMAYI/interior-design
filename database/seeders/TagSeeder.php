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
                'slug' => 'featured_products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Latest Products',
                'description' => 'latest products',
                'slug' => 'latest_products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Discounted Products',
                'description' => 'discounted products',
                'slug' => 'discounted_products',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Best Seller',
                'description' => 'best seller',
                'slug' => 'best_seller',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Trending',
                'description' => 'trending',
                'slug' => 'trending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Special Offer',
                'description' => 'special offer',
                'slug' => 'special_offer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'New Arrivals',
                'description' => 'new arrivals',
                'slug' => 'new_arrivals',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Tag::insert($tags);
    }
}
