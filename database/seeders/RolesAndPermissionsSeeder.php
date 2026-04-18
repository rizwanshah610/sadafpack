<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage staff']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'manage companies']);
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage package sizes']);

        // Super Admin — gets all permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin — can manage products, companies, package sizes but not staff
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view dashboard',
            'manage companies',
            'manage products',
            'manage package sizes',
        ]);

        // Staff — view only
        $staff = Role::create(['name' => 'staff']);
        $staff->givePermissionTo([
            'view dashboard',
        ]);

        // Assign super_admin role to first user
        $user = \App\Models\User::first();
        if ($user) {
            $user->assignRole('super_admin');
        }
    }
}