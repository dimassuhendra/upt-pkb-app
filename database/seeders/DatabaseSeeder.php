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
        User::create([
            'name' => 'Super Admin PKB',
            'username' => 'admin_pusat',
            'email' => 'admin@uptpkb.go.id',
            'password' => Hash::make('12345678'),
            'role' => 'super_admin',
        ]);
        User::create(
            [
                'name' => 'Sunaryo',
                'username' => 'admin_sunaryo',  
                'email' => 'sunaryo@upt-pkb.go.id',
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
            ]
        );
        User::create(
            [
                'name' => 'Bambang',
                'username' => 'admin_bambang',
                'email' => 'bambang@upt-pkb.go.id',
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
            ]
        );

        // 2. Mengisi Data Pemilik (Dibutuhkan untuk relasi kendaraan)
        $pemilik = Pemilik::create([
            'nik' => '3201234567890001',
            'nama_lengkap' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'L',
        ]);

        // 3. Mengisi Data Kendaraan
        Kendaraan::create([
            'pemilik_id' => $pemilik->id, // Mengambil ID dari pemilik di atas
            'no_uji' => 'JKT1234567',
            'no_kendaraan' => 'B 9999 ABC',
            'no_rangka' => 'MHM1234567890XYZ',
            'no_mesin' => 'ENG123456789',
            'merek' => 'Toyota',
            'tipe' => 'Dyna ST 110',
            'tahun_pembuatan' => 2022,
            'bahan_bakar' => 'Solar',
            'jbb' => 5000,
        ]);
    }
}