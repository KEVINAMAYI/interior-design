<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * create permissions.
     */
    public function run(): void
    {
        $permissions = [

            //categories permissions
            ['name' => 'create-categories', 'description' => 'Can create categories'],
            ['name' => 'view-categories', 'description' => 'Can view categories'],
            ['name' => 'update-categories', 'description' => 'Can update categories'],
            ['name' => 'delete-categories', 'description' => 'Can delete categories'],

            //products permissions
            ['name' => 'create-products', 'description' => 'Can create products'],
            ['name' => 'view-products', 'description' => 'Can view products'],
            ['name' => 'update-products', 'description' => 'Can update products'],
            ['name' => 'delete-products', 'description' => 'Can delete products'],

            //variations permissions
            ['name' => 'create-variations', 'description' => 'Can create variations'],
            ['name' => 'view-variations', 'description' => 'Can view variations'],
            ['name' => 'update-variations', 'description' => 'Can update variations'],
            ['name' => 'delete-variations', 'description' => 'Can delete variations'],

            //staff permissions
            ['name' => 'create-staff', 'description' => 'Can create staff'],
            ['name' => 'view-staff', 'description' => 'Can view staff'],
            ['name' => 'update-staff', 'description' => 'Can update staff'],
            ['name' => 'delete-staff', 'description' => 'Can delete staff'],

            //customers permissions
            ['name' => 'create-customers', 'description' => 'Can create customers'],
            ['name' => 'view-customers', 'description' => 'Can view customers'],
            ['name' => 'update-customers', 'description' => 'Can update customers'],
            ['name' => 'delete-customers', 'description' => 'Can delete customers'],

            //roles permissions
            ['name' => 'create-roles', 'description' => 'Can create roles'],
            ['name' => 'view-roles', 'description' => 'Can view roles'],
            ['name' => 'update-roles', 'description' => 'Can update roles'],
            ['name' => 'delete-roles', 'description' => 'Can delete roles'],

            //deals permissions
            ['name' => 'create-deals', 'description' => 'Can create deals'],
            ['name' => 'view-deals', 'description' => 'Can view deals'],
            ['name' => 'update-deals', 'description' => 'Can update deals'],
            ['name' => 'delete-deals', 'description' => 'Can delete deals'],

        ];

        //insert permissions
        foreach ($permissions as $permission) {
            if (Permission::where('name', $permission['name'])->first()) {
                continue;
            }
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description'],
            ]);
        }

        //create adminRole and assign to admin user with all permissions
        $adminRole = Role::where('name', 'admin')->first();

        $adminRole->syncPermissions(Permission::all());

        $admin = User::where('send-email.blade.php', 'admin@admin.com')->first();

        if ($admin && !$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }

    }
}
