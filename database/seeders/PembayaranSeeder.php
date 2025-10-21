<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::create([
            'order_id' => 1,
            'metode_pembayaran' => 'transfer_bank',
            'jumlah_bayar' => 195000,
            'bukti_bayar' => null,
            'status_pembayaran' => 'pending',
            'tanggal_bayar' => now(),
        ]);
    }
}
