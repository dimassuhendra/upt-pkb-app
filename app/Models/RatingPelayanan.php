<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPelayanan extends Model
{
    use HasFactory;

    // Nama tabel sesuai di database SQL Anda
    protected $table = 'ratings';

    protected $fillable = [
        'pendaftaran_id',
        'petugas_id',
        'skor_bintang',
        'kategori_keluhan',
        'komentar',
        'tampilkan_publik',
        'ip_address',
    ];

    // Relasi ke PendaftaranUji yang dinilai
    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranUji::class, 'pendaftaran_id');
    }

    // Relasi ke Petugas yang dinilai
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}