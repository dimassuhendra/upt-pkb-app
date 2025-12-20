<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranUji extends Model
{
    protected $table = 'pendaftaran_uji';
    protected $fillable = ['kendaraan_id', 'petugas_id', 'tanggal_pendaftaran', 'status'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function rating()
    {
        return $this->hasOne(RatingPelayanan::class, 'pendaftaran_id');
    }
}
