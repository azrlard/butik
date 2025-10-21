<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        OrderItem::insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'custom_request_id' => null,
                'jumlah' => 2,
                'harga_satuan' => 75000,
                'subtotal' => 2 * 75000,
                'harga' => 2 * 75000,
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'custom_request_id' => null,
                'jumlah' => 1,
                'harga_satuan' => 120000,
                'subtotal' => 1 * 120000,
                'harga' => 1 * 120000,
            ],
        ]);
    }
}
