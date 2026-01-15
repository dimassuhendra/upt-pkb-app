<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPelayanan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'ratings';

    // Update fillable agar mencakup kolom baru 'aspek_layanan'
    protected $fillable = [
        'pendaftaran_id',
        'petugas_id',
        'aspek_layanan', // Kolom baru untuk membedakan Administrasi/Pos 1-5
        'skor_bintang',
        'kategori_keluhan',
        'komentar',
        'tampilkan_publik',
        'ip_address',
    ];

    /**
     * Relasi ke PendaftaranUji (Inverse dari Pendaftaran hasMany Rating)
     */
    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranUji::class, 'pendaftaran_id');
    }

    /**
     * Relasi ke Petugas (Tabel users)
     * Berdasarkan file SQL Anda, petugas_id merujuk ke tabel users.id
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Scope untuk memudahkan filter per aspek (Optional)
     * Penggunaan: RatingPelayanan::aspek('pos_1')->get();
     */
    public function scopeAspek($query, $aspek)
    {
        return $query->where('aspek_layanan', $aspek);
    }

    /**
     * Helper untuk label yang lebih rapi (Optional)
     */
    public function getLabelAspekAttribute()
    {
        $labels = [
            'administrasi' => 'Administrasi',
            'pos_1' => 'Pos 1 (Pra Uji)',
            'pos_2' => 'Pos 2 (Emisi/Kebisingan)',
            'pos_3' => 'Pos 3 (Rem/Lampu)',
            'pos_4' => 'Pos 4 (Bawah Kendaraan)',
            'pos_5' => 'Pos 5 (Pengesahan)',
        ];

        return $labels[$this->aspek_layanan] ?? $this->aspek_layanan;
    }
}