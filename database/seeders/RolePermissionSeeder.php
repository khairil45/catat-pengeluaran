<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission
        // Admin
        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'delete-category']);
        Permission::create(['name' => 'show-user']);

        // User
        Permission::create(['name' => 'create-transaction']);
        Permission::create(['name' => 'edit-transaction']);
        Permission::create(['name' => 'delete-transaction']);
        Permission::create(['name' => 'delete-user']);

        // Role
        $adminRole = Role::create(['name' => 'admin']);
        $userRole  = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo('create-category', 'edit-category', 'delete-category', 'show-user', 'delete-user');
        $userRole->givePermissionTo('create-transaction', 'edit-transaction', 'delete-transaction', 'delete-user');
    }
}
