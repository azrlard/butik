<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'id' => 2,
            'name' => 'Pelanggan Satu',
            'email' => 'pelanggan@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
