<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Mengisi Data Admin (Tabel Users)
        User::create(
            [
                'name' => 'Admin Pusat UPT PKB',
                'username' => 'admin_pusat',
                'email' => 'admin@upt-pkb.go.id',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'admin_pendaftaran',
            ]
        );
        User::create(
            [
                'name' => 'Bambang Sartono',
                'username' => 'bambang-sartono',
                'email' => 'bambang-sartono@upt-pkb.go.id',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
                'pos_tugas' => 'Pos 1',
            ]
        );

    }
}