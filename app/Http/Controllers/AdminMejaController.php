<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminMejaController extends Controller
{
    public function index()
    {
        $meja = Meja::all();
        return view('admin.meja.index', compact('meja'));
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:mejas',
            'kapasitas' => 'required|integer',
        ]);

        $idMeja = null;

        $meja = Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'kapasitas'  => $request->kapasitas,
            'qr_code'    => '',
        ]);

        $urlMenu  = config('app.url') . '/menu/' . $meja->id_meja;
        $namaFile = 'meja-' . $meja->id_meja . '.svg';
        $savePath = public_path('assets/qrcode/' . $namaFile);

        QrCode::format('svg')->size(300)->generate($urlMenu, $savePath);

        $meja->update(['qr_code' => 'assets/qrcode/' . $namaFile]);

        return redirect('/admin/meja')->with('sukses', 'Meja berhasil ditambahkan');
    }

    public function edit($id_meja)
    {
        $meja = Meja::find($id_meja);
        return view('admin.meja.edit', compact('meja'));
    }

    public function update(Request $request, $id_meja)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:mejas,nomor_meja,' . $id_meja . ',id_meja',
            'kapasitas'  => 'required|integer',
        ]);

        $meja = Meja::find($id_meja);
        $meja->update([
            'nomor_meja' => $request->nomor_meja,
            'kapasitas'  => $request->kapasitas,
        ]);

        return redirect('/admin/meja')->with('sukses', 'Meja berhasil diperbarui');
    }

    public function destroy($id_meja)
    {
        $meja = Meja::find($id_meja);

        if ($meja && $meja->qr_code) {
            $filePath = public_path($meja->qr_code);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        Meja::destroy($id_meja);
        return redirect('/admin/meja')->with('sukses', 'Meja berhasil dihapus');
    }
}