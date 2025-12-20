<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\Kendaraan;
use App\Models\Petugas;
use App\Models\RatingPelayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Ringkasan
        $data['total_kendaraan'] = Kendaraan::count();
        $data['total_uji_hari_ini'] = PendaftaranUji::whereDate('tgl_uji', today())->count();
        $data['uji_lulus'] = PendaftaranUji::where('status_kelulusan', 'lulus')->count();
        $data['uji_gagal'] = PendaftaranUji::where('status_kelulusan', 'tidak_lulus')->count();

        // Data Rating Terbaru
        $data['recent_ratings'] = RatingPelayanan::with(['pendaftaran.kendaraan', 'petugas'])
            ->latest()
            ->take(5)
            ->get();

        // Data Antrean Uji (Yang masih proses)
        $data['antrean'] = PendaftaranUji::with('kendaraan')
            ->where('status_kelulusan', 'proses')
            ->orderBy('nomor_antrean', 'asc')
            ->get();

        return view('admin.dashboard', $data);
    }
}