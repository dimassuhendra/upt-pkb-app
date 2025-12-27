<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilUji;
use App\Models\PendaftaranUji; // Menggunakan model sesuai nama file Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Statistik 1: Jumlah antrean hari ini yang statusnya masih 'proses' atau 'menunggu'
        // Kita filter berdasarkan tgl_daftar atau created_at
        $jumlahAntrean = PendaftaranUji::whereDate('tgl_daftar', $today)
            ->whereIn('status_uji', ['proses', 'menunggu']) // Menghitung yang belum selesai
            ->count();

        // Statistik 2: Jumlah kendaraan yang sudah diperiksa oleh petugas ini hari ini
        // Data diambil dari tabel hasil_uji berdasarkan petugas_id yang sedang login
        $pemeriksaanSaya = HasilUji::where('petugas_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        // Statistik 3: Ambil 5 riwayat pemeriksaan terakhir oleh petugas ini
        // Note: Pastikan di model HasilUji sudah ada function pendaftaran() 
        // yang isinya return $this->belongsTo(PendaftaranUji::class, 'pendaftaran_id');
        $riwayatTerakhir = HasilUji::with(['pendaftaran.kendaraan'])
            ->where('petugas_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact('user', 'jumlahAntrean', 'pemeriksaanSaya', 'riwayatTerakhir'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('petugas.profil', compact('user'));
    }
}