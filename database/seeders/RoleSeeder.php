<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'admin'],
            ['name' => 'staff', 'description' => 'staff']
        ];

        foreach ($roles as $role) {
            $check = Role::where('name', $role['name'])->first();

            if (empty($check)) {
                Role::create([
                    'name' => $role['name'],
                    'description' => $role['description']
                ]);
            }
        }

    }
}
