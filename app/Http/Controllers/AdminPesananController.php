<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Meja;
use Illuminate\Support\Facades\Auth;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['meja', 'detail.menu', 'user'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function prosesPembayaran($id_pesanan)
    {
        $pesanan = Pesanan::find($id_pesanan);

        if (!$pesanan) {
            return back()->withErrors(['pesan' => 'Pesanan tidak ditemukan']);
        }

        if ($pesanan->metode_pembayaran !== 'tunai') {
            return back()->withErrors(['pesan' => 'Hanya pesanan tunai yang bisa diproses di sini']);
        }

        if ($pesanan->status_pembayaran === 'lunas') {
            return back()->withErrors(['pesan' => 'Pesanan ini sudah lunas']);
        }

        // Catat admin yang melunaskan sebagai PIC
        $pesanan->update([
            'status_pembayaran' => 'lunas',
            'id_user'           => Auth::user()->id_user,
        ]);

        return back()->with('sukses', 'Pembayaran pesanan ' . $pesanan->nomor_pesanan . ' berhasil dikonfirmasi oleh ' . Auth::user()->nama . '!');
    }

    public function selesai($id_pesanan)
    {
        $pesanan = Pesanan::find($id_pesanan);

        if (!$pesanan) {
            return back()->withErrors(['pesan' => 'Pesanan tidak ditemukan']);
        }

        if ($pesanan->status_pesanan !== 'siap_diambil') {
            return back()->withErrors(['pesan' => 'Pesanan belum siap diambil']);
        }

        if ($pesanan->status_pembayaran !== 'lunas') {
            return back()->withErrors(['pesan' => 'Pembayaran belum dikonfirmasi']);
        }

        $pesanan->update(['status_pesanan' => 'selesai']);

        if ($pesanan->id_meja) {
            $masihAda = Pesanan::where('id_meja', $pesanan->id_meja)
                ->whereIn('status_pesanan', ['menunggu', 'diproses', 'siap_diambil'])
                ->exists();

            if (!$masihAda) {
                Meja::where('id_meja', $pesanan->id_meja)->update(['status' => 'tersedia']);
            }
        }

        return back()->with('sukses', 'Pesanan ' . $pesanan->nomor_pesanan . ' selesai. Meja dibebaskan jika tidak ada pesanan aktif lain.');
    }
}