<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\RatingPelayanan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard petugas
        $hariIni = Carbon::today();

        $stats = [
            'total_uji_hari_ini' => PendaftaranUji::whereDate('tgl_uji', $hariIni)->count(),
            'lulus_hari_ini' => PendaftaranUji::whereDate('tgl_uji', $hariIni)
                ->where('status_kelulusan', 'lulus')->count(),
            'rating_rata_rata' => RatingPelayanan::avg('skor_bintang') ?? 0,
        ];

        $posPetugas = Auth::user()->role; // Contoh: role 'petugas_emisi'

        $antreanPos = PendaftaranUji::where('pos_sekarang', $posPetugas)
            ->where('status_kelulusan', 'proses')
            ->get();

        return view('petugas.dashboard', compact('antreanPos', 'stats'));
    }
}