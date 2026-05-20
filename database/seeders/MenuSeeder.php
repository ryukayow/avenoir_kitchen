<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menu = [
            ['id_kategori' => 1, 'nama_menu' => 'Mie Ayam', 'deskripsi' => 'Mie ayam premium dengan topping ayam cincang, sawi, dan pangsit', 'harga' => 45000, 'gambar' => 'assets/img/menu/1778374972_Mie_Ayam-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 2, 'nama_menu' => 'Spaghetti', 'deskripsi' => 'Spaghetti premium dengan saus autentik pilihan', 'harga' => 50000, 'gambar' => 'assets/img/menu/1778375026_spaghetti-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 3, 'nama_menu' => 'Tempura', 'deskripsi' => 'Udang dan sayuran tempura goreng renyah (3 pcs)', 'harga' => 28000, 'gambar' => 'assets/img/menu/1778375043_Shrimp_Tempura-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 3, 'nama_menu' => 'Soup Cream', 'deskripsi' => 'Sup krim hangat yang lembut dan creamy', 'harga' => 22000, 'gambar' => 'assets/img/menu/1778375057_soup_cream-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 3, 'nama_menu' => 'Sushi', 'deskripsi' => 'Sushi roll premium (4 pcs)', 'harga' => 32000, 'gambar' => 'assets/img/menu/1778375081_sushi-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 4, 'nama_menu' => 'Teh Manis', 'deskripsi' => 'Teh manis segar dingin', 'harga' => 12000, 'gambar' => 'assets/img/menu/1778375149_teh_manis-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 4, 'nama_menu' => 'Ocha', 'deskripsi' => 'Green tea dingin', 'harga' => 15000, 'gambar' => 'assets/img/menu/1778375168_ocha-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 4, 'nama_menu' => 'Jus Mangga', 'deskripsi' => 'Jus mangga segar tanpa pengawet', 'harga' => 20000, 'gambar' => 'assets/img/menu/1778375190_mangga-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 4, 'nama_menu' => 'Jus Alpukat', 'deskripsi' => 'Jus alpukat segar dengan susu', 'harga' => 22000, 'gambar' => 'assets/img/menu/1778375204_alpukat-removebg-preview.png', 'status_tersedia' => true],
            ['id_kategori' => 4, 'nama_menu' => 'Jus Stroberi', 'deskripsi' => 'Jus stroberi segar', 'harga' => 20000, 'gambar' => 'assets/img/menu/1778375218_stroberi-removebg-preview.png', 'status_tersedia' => true],
        ];

        foreach ($menu as $m) {
            Menu::firstOrCreate(['nama_menu' => $m['nama_menu']], $m);
        }
    }
}