<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\KategoriMenu;
use App\Models\DetailPesanan;

class AdminMenuController extends Controller
{
    public function dashboard()
    {
        $detailPesanan = DetailPesanan::with(['pesanan.meja', 'menu'])
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $kategoriMenu = KategoriMenu::withCount('menus')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.dashboard.index', compact(
            'detailPesanan', 'kategoriMenu'
        ));
    }

    public function index()
    {
        $menu = Menu::with('kategori')->get();
        return view('admin.menu.index', compact('menu'));
    }

    public function create()
    {
        $kategori = KategoriMenu::all();
        return view('admin.menu.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'status_tersedia' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'status_tersedia' => $request->status_tersedia ?? false,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/menu'), $namaFile);
            $data['gambar'] = 'assets/img/menu/' . $namaFile;
        }

        Menu::create($data);

        return redirect('/admin/menu')->with('sukses', 'Menu berhasil ditambahkan');
    }

    public function edit($id_menu)
    {
        $menu = Menu::find($id_menu);
        $kategori = KategoriMenu::all();
        return view('admin.menu.edit', compact('menu', 'kategori'));
    }

    public function update(Request $request, $id_menu)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'status_tersedia' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $menu = Menu::find($id_menu);
        
        $data = [
            'id_kategori' => $request->id_kategori,
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'status_tersedia' => $request->status_tersedia ?? false,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/menu'), $namaFile);
            
            // Hapus gambar lama jika ada
            if ($menu->gambar && file_exists(public_path($menu->gambar))) {
                unlink(public_path($menu->gambar));
            }

            $data['gambar'] = 'assets/img/menu/' . $namaFile;
        }

        $menu->update($data);

        return redirect('/admin/menu')->with('sukses', 'Menu berhasil diupdate');
    }

    public function destroy($id_menu)
    {
        Menu::destroy($id_menu);
        return redirect('/admin/menu')->with('sukses', 'Menu berhasil dihapus');
    }
}