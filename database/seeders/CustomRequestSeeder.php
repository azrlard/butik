<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomRequest;

class CustomRequestSeeder extends Seeder
{
    public function run(): void
    {
        CustomRequest::create([
            'user_id' => 2,
            'foto_referensi' => 'custom_kaos.png',
            'foto_request' => null,
            'keterangan' => 'Ingin desain warna biru dengan logo di tengah.',
            'status' => 'pending',
            'harga_estimasi' => 150000,
        ]);
    }
}
