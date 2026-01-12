<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Petugas extends Authenticatable
{
    use HasFactory;

    // Karena di DB nama tabelnya adalah 'users'
    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'pos_tugas',
        'is_active',
    ];

    /**
     * Boot function untuk memfilter agar Model ini 
     * HANYA mengambil data yang rolenya 'petugas'.
     */
    protected static function booted()
    {
        static::addGlobalScope('role_petugas', function (Builder $builder) {
            $builder->where('role', 'petugas');
        });
    }

    // Relasi jika ingin melihat pendaftaran yang ditangani petugas ini
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranUji::class, 'petugas_id');
    }
}