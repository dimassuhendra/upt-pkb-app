<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',      // super_admin, admin_pendaftaran, petugas
        'pos_tugas', // Pos 1 sampai Pos 5
        'is_active', // Status akun (1 atau 0)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean', // Agar nilai 1/0 otomatis menjadi true/false di aplikasi
        ];
    }

    /**
     * Helper untuk mengecek apakah user adalah petugas di pos tertentu
     */
    public function isDiPos($pos)
    {
        return $this->role === 'petugas' && $this->pos_tugas === $pos;
    }
}