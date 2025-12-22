<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUji;
use App\Models\Petugas;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    public function index()
    {
        // 1. Perbaikan: Panggil nama relasi 'rating', bukan nama kolom 'skor_bintang'
        $antreanSurvei = PendaftaranUji::whereIn('status_kelulusan', ['lulus', 'tidak_lulus'])
            ->whereDoesntHave('RatingPelayanan')
            ->with('kendaraan.pemilik')
            ->orderBy('tgl_uji', 'asc')
            ->first(); 

        // 2. Ambil data petugas
        $petugas = Petugas::all();

        return view('survei.index', compact('antreanSurvei', 'petugas'));
    }
}