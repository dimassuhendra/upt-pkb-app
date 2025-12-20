<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUji;
use App\Models\Petugas;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    public function index()
    {
        // Cari pendaftaran yang sudah selesai tapi BELUM ada di tabel rating
        $antreanSurvei = PendaftaranUji::whereIn('status_kelulusan', ['lulus', 'tidak_lulus'])
            ->whereDoesntHave('rating')
            ->with('kendaraan.pemilik')
            ->orderBy('tgl_uji', 'asc')
            ->first(); // Ambil satu yang paling lama (urut)

        // Ambil data petugas untuk dipilih siapa yang dinilai
        $petugas = Petugas::all();

        return view('survei.index', compact('antreanSurvei', 'petugas'));
    }
}
