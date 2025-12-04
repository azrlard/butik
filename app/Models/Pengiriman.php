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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected static function booted()
    {
        // Event untuk CREATE (saat data baru dibuat)
        static::created(function ($pengiriman) {
            $order = $pengiriman->order;
            if ($order) {
                if ($pengiriman->status_pengiriman === 'dikirim') {
                    $order->update(['status' => 'shipped']);
                } elseif ($pengiriman->status_pengiriman === 'sampai') {
                    $order->update(['status' => 'completed']);
                }
            }
        });

        // Event untuk UPDATE (saat data diubah)
        static::updated(function ($pengiriman) {
            if ($pengiriman->isDirty('status_pengiriman')) {
                $order = $pengiriman->order;
                if ($order) {
                    if ($pengiriman->status_pengiriman === 'dikirim') {
                        $order->update(['status' => 'shipped']);
                    } elseif ($pengiriman->status_pengiriman === 'sampai') {
                        $order->update(['status' => 'completed']);
                    }
                }
            }
        });
    }
}
