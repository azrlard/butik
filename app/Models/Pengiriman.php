<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'order_id',
        'nama_penerima',
        'alamat_pengiriman',
        'no_hp',
        'kurir',
        'no_resi',
        'status_pengiriman',
        'tanggal_kirim',
        'tanggal_terima',
    ];
}
