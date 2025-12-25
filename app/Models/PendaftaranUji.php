<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranUji extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'kendaraan_id',
        'petugas_id',
        'kode_pendaftaran',
        'tgl_daftar',
        'nomor_antrian',
        'jenis_pendaftaran',
        'total_biaya',
        'metode_pembayaran',
        'status_pembayaran',
        'tgl_bayar',
        'status_uji',
        'catatan_petugas',
        'foto_kendaraan',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
