<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin 1',
            'username' => 'admin1',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Admin 2',
            'username' => 'admin2',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Koki Utama',
            'username' => 'koki',
            'password' => Hash::make('koki123'),
            'role' => 'koki',
        ]);
    }
}