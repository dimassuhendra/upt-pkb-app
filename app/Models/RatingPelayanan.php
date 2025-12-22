<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPelayanan extends Model
{
    use HasFactory;

    // Nama tabel sesuai di database SQL Anda
    protected $table = 'rating_pelayanan';

    protected $fillable = [
        'pendaftaran_id',
        'petugas_id',
        'skor_bintang',
        'komentar_saran',
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