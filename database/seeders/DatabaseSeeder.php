<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Dummy Data
        $this->call([
            CompanySeeder::class,
            ProductSeeder::class,
            PackageSizeSeeder::class,
        ]);

        // Create default super admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Roles and permissions (must run after user is created)
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}