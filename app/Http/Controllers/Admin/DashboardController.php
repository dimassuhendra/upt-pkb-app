<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\HasilUji;
use App\Models\RatingPelayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'total_daftar' => PendaftaranUji::whereDate('tgl_daftar', $today)->count(),
            'sedang_uji' => PendaftaranUji::where('status_uji', 'proses')->count(),
            'lulus' => HasilUji::whereDate('created_at', $today)->where('hasil_akhir', 'lulus')->count(),
            'gagal' => HasilUji::whereDate('created_at', $today)->where('hasil_akhir', 'tidak_lulus')->count(),
        ];

        // Gunakan with() hanya untuk yang diperlukan, dan pastikan data tidak null
        $recent_ratings = RatingPelayanan::with(['pendaftaran.kendaraan'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_ratings'));
    }
}