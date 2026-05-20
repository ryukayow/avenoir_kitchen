<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        $meja = [
            ['nomor_meja' => 'M01', 'kapasitas' => 4, 'qr_code' => '/qrcode/meja-1.png'],
        ];

        foreach ($meja as $m) {
            Meja::firstOrCreate(['nomor_meja' => $m['nomor_meja']], $m);
        }
    }
}