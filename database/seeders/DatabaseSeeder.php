<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Always create the main Admin account
        User::firstOrCreate(
            ['email' => 'vbat.admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Update this as needed
                'role' => 'admin',
            ]
        );

        // 2. Create a standard test user (Optional)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );
    }
}