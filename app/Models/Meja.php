<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $primaryKey = 'id_meja';
    protected $fillable = [
        'nomor_meja',
        'kapasitas',
        'qr_code',
        'status'
    ];
}