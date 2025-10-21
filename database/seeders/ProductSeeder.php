<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'nama_produk' => 'Kaos Polos',
                'deskripsi' => 'Kaos polos berkualitas tinggi.',
                'harga' => 75000,
                'stok' => 50,
                'foto' => 'kaos.jpg',
                'tipe_produk' => 'ready'
            ],
            [
                'category_id' => 2,
                'nama_produk' => 'Gelang Custom',
                'deskripsi' => 'Gelang dengan desain sesuai keinginan.',
                'harga' => 120000,
                'stok' => 10,
                'foto' => 'gelang.jpg',
                'tipe_produk' => 'custom'
            ],
        ]);
    }
}
