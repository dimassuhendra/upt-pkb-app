<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUji;
use App\Models\Petugas;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    // app/Http/Controllers/SurveiController.php

    public function index()
    {
        $antreanSurvei = PendaftaranUji::whereIn('status_uji', ['Lulus', 'Tidak Lulus']) // Sesuaikan dengan enum di DB
            ->whereDoesntHave('rating') // Memanggil fungsi rating() di Model
            ->with('kendaraan.pemilik')
            ->orderBy('tgl_daftar', 'asc') // Sesuai kolom di tabel 'pendaftaran'
            ->first();

        $petugas = Petugas::all();

        return view('survei.index', compact('antreanSurvei', 'petugas'));
    }
}