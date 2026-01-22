<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingPelayanan;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Menampilkan Form Rating untuk Pemilik Kendaraan
     */
    public function index(Request $request)
    {
        $pendaftaran = null;
        if ($request->filled('no_uji')) {
            $pendaftaran = PendaftaranUji::where('no_uji', $request->no_uji)->first();
        }

        return view('rating', compact('pendaftaran'));
    }

    /**
     * Menyimpan Penilaian
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'aspek_layanan' => 'required|string',
            'skor_bintang' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string|max:500',
        ]);

        // Cek Double Input untuk aspek yang sama
        $cek = RatingPelayanan::where('pendaftaran_id', $request->pendaftaran_id)
            ->where('aspek_layanan', $request->aspek_layanan)
            ->exists();

        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk aspek ini.');
        }

        RatingPelayanan::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'aspek_layanan' => $request->aspek_layanan,
            'skor_bintang' => $request->skor_bintang,
            'komentar' => $request->komentar,
            'ip_address' => $request->ip(),
            'tampilkan_publik' => true
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Penilaian Anda sangat membantu kami.');
    }

    /**
     * Rekap untuk Admin
     */
    public function adminRekap()
    {
        $ratings = RatingPelayanan::with('pendaftaran.kendaraan')->latest()->paginate(10);

        // Menghitung rata-rata skor per aspek
        $statistik = RatingPelayanan::selectRaw('aspek_layanan, AVG(skor_bintang) as rata_rata')
            ->groupBy('aspek_layanan')
            ->get();

        return view('rating-rekap', compact('ratings', 'statistik'));
    }
}