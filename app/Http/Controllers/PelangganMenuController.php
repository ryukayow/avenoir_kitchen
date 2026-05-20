<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\KategoriMenu;
use App\Models\Meja;

class PelangganMenuController extends Controller
{
    public function index($id_meja)
    {
        $meja = Meja::where('id_meja', $id_meja)->first();

        if (!$meja) {
            abort(404, 'Meja tidak ditemukan');
        }

        $semuaKategori = KategoriMenu::with(['menus' => function ($q) {
            $q->where('status_tersedia', true);
        }])->get();

        $namaFood = ['Mie Ayam', 'Spaghetti'];
        $menuFood  = collect();
        $sisaKat   = collect();

        foreach ($semuaKategori as $kat) {
            if (in_array($kat->nama_kategori, $namaFood)) {
                $menuFood = $menuFood->merge($kat->menus);
            } else {
                $sisaKat->push($kat);
            }
        }

        $foodGroup = (object)[
            'id_kategori'   => 'food',
            'nama_kategori' => 'Food',
            'menus'         => $menuFood,
        ];

        $kategori = collect([$foodGroup])->merge($sisaKat);

        return view('pelanggan.menu.index', compact('kategori', 'meja'));
    }
}