<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class KokiPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['meja', 'detail.menu'])
            ->whereIn('status_pesanan', ['menunggu', 'diproses'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('koki.kitchen.index', compact('pesanan'));
    }

    public function mulaiMasak($id_pesanan)
    {
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->update(['status_pesanan' => 'diproses']);

        return back()->with('sukses', 'Status diubah menjadi Diproses');
    }

    public function selesai($id_pesanan)
    {
        $pesanan = Pesanan::find($id_pesanan);
        $pesanan->update(['status_pesanan' => 'siap_diambil']);

        return back()->with('sukses', 'Pesanan selesai, siap diambil');
    }
}