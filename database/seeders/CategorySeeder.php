<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['nama_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Aksesoris'],
            ['nama_kategori' => 'Elektronik'],
        ]);
    }
}
