<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingPelayanan;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Halaman untuk USER/PEMILIK mengisi rating
     */
    public function index(Request $request)
    {
        $pendaftaran = null;
        if ($request->filled('no_uji')) {
            $pendaftaran = PendaftaranUji::where('no_uji', $request->no_uji)->first();
        }

        // Kita gunakan file yang sama tapi dengan flag mode 'input'
        return view('admin.rating', [
            'pendaftaran' => $pendaftaran,
            'mode' => 'input'
        ]);
    }

    /**
     * Simpan rating
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pendaftaran' => 'required|exists:kode_pendaftaran,id',
            'aspek_layanan' => 'required|string',
            'skor_bintang' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string|max:500',
        ]);

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
     * Halaman untuk ADMIN melihat rekap
     */
    public function adminIndex()
    {
        $ratings = RatingPelayanan::with('pendaftaran.kendaraan')->latest()->paginate(10);

        $statistik = RatingPelayanan::selectRaw('aspek_layanan, AVG(skor_bintang) as rata_rata')
            ->groupBy('aspek_layanan')
            ->get();

        // Kita gunakan file yang sama tapi dengan flag mode 'rekap'
        return view('admin.rating', [
            'ratings' => $ratings,
            'statistik' => $statistik,
            'mode' => 'rekap',
            'pendaftaran' => null // Set null agar tidak kena error undefined
        ]);
    }
}