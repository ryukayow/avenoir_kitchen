<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_pesanan',
        'id_menu',
        'jumlah',
        'harga_satuan',
        'subtotal',
        'catatan_item'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}