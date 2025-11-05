<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // CategorySeeder::class, // Disabled for manual testing
            // ProductSeeder::class, // Disabled for manual testing
            // CustomRequestSeeder::class, // Disabled for manual testing
            // OrderSeeder::class, // Disabled for manual testing
            // OrderItemSeeder::class, // Disabled for manual testing
            // PengirimanSeeder::class, // Disabled for manual testing
            // PembayaranSeeder::class, // Disabled for manual testing
        ]);
    }

}
