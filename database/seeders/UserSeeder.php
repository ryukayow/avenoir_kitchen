<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin1'],
            [
                'nama' => 'Admin 1',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'admin2'],
            [
                'nama' => 'Admin 2',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'koki'],
            [
                'nama' => 'Koki Utama',
                'password' => Hash::make('koki123'),
                'role' => 'koki',
            ]
        );
    }
}