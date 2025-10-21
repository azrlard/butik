<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // ✅ tambahkan ini

    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'bukti_bayar',
        'status_pembayaran',
        'tanggal_bayar',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
