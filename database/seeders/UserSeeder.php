<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin Pendakian',
            'email' => 'admin@tiketpendakian.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'email_verified_at' => now(),
        ]);

        // User Pendaki
        User::create([
            'name' => 'Pendaki User',
            'email' => 'pendaki@tiketpendakian.com',
            'password' => Hash::make('pendaki123'),
            'role' => 'Pendaki',
            'email_verified_at' => now(),
        ]);

        // Test User
        User::create([
            'name' => 'Test User',
            'email' => 'test@tiketpendakian.com',
            'password' => Hash::make('test123'),
            'role' => 'Pendaki',
            'email_verified_at' => now(),
        ]);
    }
}
