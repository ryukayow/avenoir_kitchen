<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Meja;
use Carbon\Carbon;

class PelangganPesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_meja' => 'required|exists:mejas,id_meja',
            'items' => 'required|array|min:1',
            'items.*.id_menu' => 'required|exists:menus,id_menu',
            'items.*.jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,qris',
            'catatan' => 'nullable|string',
        ]);

        $totalHarga = 0;
        foreach ($request->items as $item) {
            $menu = \App\Models\Menu::find($item['id_menu']);
            if (!$menu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu tidak ditemukan',
                ], 400);
            }
            $totalHarga += $menu->harga * $item['jumlah'];
        }

        do {
            $nomorPesanan = 'PSN-' . Carbon::now()->format('YmdHis') . random_int(10, 99);
        } while (Pesanan::where('nomor_pesanan', $nomorPesanan)->exists());

        $pesanan = Pesanan::create([
            'id_meja' => $request->id_meja,
            'nomor_pesanan' => $nomorPesanan,
            'total_harga' => $totalHarga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->metode_pembayaran === 'qris' ? 'lunas' : 'belum_bayar',
            'status_pesanan' => 'menunggu',
            'catatan' => $request->catatan,
        ]);

        foreach ($request->items as $item) {
            $menu = \App\Models\Menu::find($item['id_menu']);
            if (!$menu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu tidak valid',
                ], 400);
            }
            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_menu' => $item['id_menu'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $menu->harga,
                'subtotal' => $menu->harga * $item['jumlah'],
            ]);
        }

        Meja::where('id_meja', $request->id_meja)->update(['status' => 'terisi']);

        return response()->json([
            'success' => true,
            'nomor_pesanan' => $nomorPesanan,
        ]);
    }

    public function tracking($nomor_pesanan)
    {
        $pesanan = Pesanan::with(['detail.menu', 'meja'])
            ->where('nomor_pesanan', $nomor_pesanan)
            ->first();

        if (!$pesanan) {
            abort(404, 'Pesanan tidak ditemukan');
        }

        return view('pelanggan.tracking.index', compact('pesanan'));
    }
}