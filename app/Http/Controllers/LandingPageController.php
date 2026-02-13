<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HasilUji; // Pastikan Model diimport
use App\Models\RatingPelayanan; // Tambahkan import Model Rating
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan Library PDF diimport

class LandingPageController extends Controller
{
    public function index()
    {
        $title = "UPT PKB Kota Bandar Lampung";

        // 1. Ambil rata-rata skor bintang dari semua aspek untuk ditampilkan sebagai summary
        $avgRating = DB::table('ratings')->avg('skor_bintang');

        // 2. Ambil beberapa rating terbaru yang memiliki komentar untuk ditampilkan sebagai testimoni
        // Kita gunakan eager loading untuk mengambil nama pemilik kendaraan jika diperlukan
        $testimoni = RatingPelayanan::with(['pendaftaran.kendaraan.pemilik'])
            ->whereNotNull('komentar')
            ->where('tampilkan_publik', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('survei.index', compact('title', 'avgRating', 'testimoni'));
    }

    public function cekMasaBerlaku(Request $request)
    {
        $request->validate([
            'no_kendaraan' => 'required|string',
        ]);

        // Mencari kendaraan beserta data pendaftaran terakhirnya
        $kendaraan = DB::table('kendaraan')
            ->where('no_kendaraan', $request->no_kendaraan)
            ->first();

        if (!$kendaraan) {
            return back()->with('error', 'Data kendaraan tidak tersedia. Lakukan uji KIR terlebih dahulu.');
        }

        // Cari hasil uji terakhir untuk kendaraan ini agar bisa muncul tombol cetak
        $hasilTerakhir = HasilUji::whereHas('pendaftaran', function ($q) use ($kendaraan) {
            $q->where('kendaraan_id', $kendaraan->id);
        })->latest()->first();

        // Kita kirim data kendaraan dan ID hasil uji terakhir ke view
        return back()->with([
            'hasil' => $kendaraan,
            'hasil_uji_id' => $hasilTerakhir ? $hasilTerakhir->id : null
        ]);
    }

    /**
     * Fitur tambahan untuk cetak PDF dari Landing Page
     */
    public function cetakHasilPublic($id)
    {
        // Ambil data hasil uji lengkap dengan relasinya
        $data = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])->findOrFail($id);

        // Gunakan view yang sama dengan yang digunakan Admin agar formatnya konsisten
        $pdf = Pdf::loadView('admin.cetak-hasil-pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Hasil_Uji_' . $data->pendaftaran->kendaraan->no_kendaraan . '.pdf');
    }
}
