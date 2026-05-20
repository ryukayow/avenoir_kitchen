<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $primaryKey = 'id_pesanan';
    protected $fillable = [
        'id_meja',
        'nomor_pesanan',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran',
        'status_pesanan',
        'catatan',
        'id_user'
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}