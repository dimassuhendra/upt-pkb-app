<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranUji extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pendaftaran_uji';

    protected $fillable = [
        'kendaraan_id',
        'petugas_id',
        'tgl_uji',
        'nomor_antrean',
        'hasil_emisi',
        'hasil_klakson',
        'hasil_lampu',
        'hasil_rem',
        'hasil_kuncup_roda',
        'hasil_spedometer',
        'pos_sekarang',
        'status_kelulusan',
        'biaya_retribusi',
    ];

    // Relasi ke Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    // Relasi ke Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    // Relasi ke RatingPelayanan
    public function RatingPelayanan()
    {
        return $this->hasOne(RatingPelayanan::class, 'pendaftaran_id', 'id');
    }
}