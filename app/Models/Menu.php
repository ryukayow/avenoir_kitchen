<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'id_kategori',
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
        'status_tersedia'
    ];
    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'id_kategori');
    }
}