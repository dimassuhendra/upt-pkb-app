<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'pemilik_id',
        'no_kendaraan',
        'no_rangka',
        'no_mesin',
        'no_bpkb',
        'merek',
        'tipe',
        'jenis_kendaraan',
        'model',
        'tahun_pembuatan',
        'tahun_perakitan',
        'isi_silinder',
        'warna',
        'warna_tnkb',
        'bahan_bakar',
        'jumlah_roda',
        'jumlah_sumbu',
        'kapasitas_penumpang',
        'berat_kosong',
        'jbb',
        'jbi',
        'masa_berlaku_stnk',
        'masa_berlaku_uji_kir',
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id');
    }
}
