<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManajerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'manajer@butik.com'],
            [
                'name' => 'Manajer Butik',
                'password' => Hash::make('manajer123'),
                'role' => 'manajer',
            ]
        );
    }
}
