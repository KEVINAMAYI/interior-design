<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Staff;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         * uncomment only for testing
         */
//        User::factory()->count(5)->create();
//        Staff::factory()->count(5)->create();
//        Customer::factory()->count(5)->create();

        $this->call([
            CategorySeeder::class,
            VariationSeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            StaffSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            CarouselSeeder::class
        ]);
    }
}
