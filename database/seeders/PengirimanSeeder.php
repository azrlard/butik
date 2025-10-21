<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengiriman;

class PengirimanSeeder extends Seeder
{
    public function run(): void
    {
        Pengiriman::create([
            'order_id' => 1,
            'nama_penerima' => 'Andi Setiawan',
            'alamat_pengiriman' => 'Jl. Merdeka No. 45, Jakarta',
            'no_hp' => '08123456789',
            'kurir' => 'JNE',
            'no_resi' => 'JNE123456789',
            'status_pengiriman' => 'dikirim', // harus sesuai enum
            'tanggal_kirim' => now(),
            'tanggal_terima' => null,
        ]);
    }
}
