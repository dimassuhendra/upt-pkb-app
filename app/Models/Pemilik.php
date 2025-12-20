<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{

    protected $table = 'pemilik';
    protected $fillable = ['nik', 'nama_lengkap', 'alamat', 'no_hp', 'jenis_kelamin'];
}
