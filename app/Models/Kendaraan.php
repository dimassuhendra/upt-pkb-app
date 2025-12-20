<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = ['pemilik_id', 'no_uji', 'no_kendaraan', 'no_rangka', 'no_mesin', 'merek', 'tipe', 'tahun_pembuatan', 'bahan_bakar', 'jbb'];
}
