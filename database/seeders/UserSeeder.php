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
         // User admin
         $admin = User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => Hash::make('123456'),
        ]);
        $admin->assignRole('Admin');

        // Contoh user biasa
        $user = User::create([
            'name' => 'User Biasa',
            'email' => 'user@toko.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole('User');
    }
}
