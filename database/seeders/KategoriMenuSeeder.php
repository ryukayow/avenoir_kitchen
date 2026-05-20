<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriMenu;

class KategoriMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Mie Ayam', 'Spaghetti', 'Side Dish', 'Minuman'];

        foreach ($data as $nama) {
            KategoriMenu::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
