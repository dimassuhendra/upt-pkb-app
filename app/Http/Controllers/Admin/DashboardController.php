<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\HasilUji;
use App\Models\RatingPelayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // Mengambil rating terbaru yang dikelompokkan per pendaftaran
        $recent_ratings = RatingPelayanan::with(['pendaftaran.kendaraan'])
            ->select(
                'pendaftaran_id',
                DB::raw('AVG(skor_bintang) as rata_rata'),
                DB::raw('MAX(komentar) as komentar_utama'), // Mengambil komentar (biasanya dari bag. administrasi)
                DB::raw('MAX(created_at) as tgl_rating')
            )
            ->groupBy('pendaftaran_id')
            ->latest('tgl_rating')
            ->limit(10) // Kita tambah limitnya karena tabel sekarang lebih luas
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_ratings'));
    }
}