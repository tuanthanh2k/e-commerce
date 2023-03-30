<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'supper-admin', 'display_name' => 'Supper Admin', 'group' => 'system'],
            ['name' => 'admin', 'display_name' => 'Admin', 'group' => 'system'],
            ['name' => 'employee', 'display_name' => 'Employee', 'group' => 'system'],
            ['name' => 'manager', 'display_name' => 'Manager', 'group' => 'system'],
            ['name' => 'user', 'display_name' => 'User', 'group' => 'system'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }

        $superAdmin = User::whereEmail('admin@gmail.com')->first();

        if (!$superAdmin) {
            $superAdmin = User::factory()->create(['email' => 'admin@gmail.com', 'password' => '$2y$10$msGHkPt0lECyKAbRaCrwv.chbTJ3duN.Sppaiyo6LdFDp50ZXH236']);
        }
        $superAdmin->assignRole('supper-admin');

        $permission = [
            ['name' => 'create-user', 'display_name' => 'Create User', 'group' => 'User'],
            ['name' => 'update-user', 'display_name' => 'Update User', 'group' => 'User'],
            ['name' => 'show-user', 'display_name' => 'Show User', 'group' => 'User'],
            ['name' => 'delete-user', 'display_name' => 'Delete User', 'group' => 'User'],

            ['name' => 'create-role', 'display_name' => 'Create Role', 'group' => 'Role'],
            ['name' => 'update-role', 'display_name' => 'Update Role', 'group' => 'Role'],
            ['name' => 'show-role', 'display_name' => 'Show Role', 'group' => 'Role'],
            ['name' => 'delete-role', 'display_name' => 'Delete Role', 'group' => 'Role'],

            ['name' => 'create-category', 'display_name' => 'Create Category', 'group' => 'Category'],
            ['name' => 'update-category', 'display_name' => 'Update Category', 'group' => 'Category'],
            ['name' => 'show-category', 'display_name' => 'Show Category', 'group' => 'Category'],
            ['name' => 'delete-category', 'display_name' => 'Delete Category', 'group' => 'Category'],

            ['name' => 'create-product', 'display_name' => 'Create Product', 'group' => 'product'],
            ['name' => 'update-product', 'display_name' => 'Update Product', 'group' => 'product'],
            ['name' => 'show-product', 'display_name' => 'Show Product', 'group' => 'product'],
            ['name' => 'delete-product', 'display_name' => 'Delete Product', 'group' => 'product'],

            ['name' => 'create-coupon', 'display_name' => 'Create Coupon', 'group' => 'Coupon'],
            ['name' => 'update-coupon', 'display_name' => 'Update Coupon', 'group' => 'Coupon'],
            ['name' => 'show-coupon', 'display_name' => 'Show Coupon', 'group' => 'Coupon'],
            ['name' => 'delete-coupon', 'display_name' => 'Delete Coupon', 'group' => 'Coupon'],
        ];
        foreach ($permission as $per) {
            Permission::updateOrCreate($per);
        }
    }
}
