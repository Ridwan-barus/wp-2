<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@batik.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => Hash::make('admin123'),
            
        ]);

        // User Biasa
        User::create([
            'nama' => 'User',
            'email' => 'user@batik.com',
            'role' => '0',
            'status' => 1,
            'hp' => '0812345678902',
            'password' => Hash::make('user123'),
            
        ]);
    }
}
