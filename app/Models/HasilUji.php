<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUji extends Model
{
    use HasFactory;
    protected $table = 'hasil_uji';

    protected $fillable = [
        'pendaftaran_id',
        'petugas_id',
        'kondisi_ban',
        'kondisi_kaca',
        'klakson',
        'wiper',
        'lampu_sign',
        'kedalaman_alur_ban',
        'emisi_co',
        'emisi_hc',
        'emisi_asap_opasitas',
        'rem_utama_kiri',
        'rem_utama_kanan',
        'selisih_rem_per_sumbu',
        'rem_parkir',
        'lampu_utama_kekuatan',
        'lampu_utama_penyimpangan',
        'kebisingan_desibel',
        'side_slip',
        'hasil_akhir',
        'masa_berlaku_sampai',
        'catatan_perbaikan',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranUji::class, 'pendaftaran_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
