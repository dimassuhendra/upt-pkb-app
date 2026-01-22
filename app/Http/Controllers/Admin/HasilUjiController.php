<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\HasilUji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilUjiController extends Controller
{
    /**
     * Menampilkan halaman utama hasil uji (Antrean & Rekap)
     */
    public function hasil_uji()
    {
        // 1. Ambil data yang sudah selesai diuji (Rekap)
        $rekap = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])->latest()->get();

        // 2. Ambil data pendaftaran yang masih dalam antrean (Menunggu atau Proses)
        $antrean = PendaftaranUji::with(['kendaraan.pemilik'])
            ->whereIn('status_uji', ['menunggu', 'proses'])
            ->latest()
            ->get();

        return view('admin.hasil-uji', compact('rekap', 'antrean'));
    }

    /**
     * Menyimpan data hasil uji dari 5 Pos Pemeriksaan
     */
    public function store(Request $request, $id)
    {
        // Validasi input minimal
        $request->validate([
            'hasil_akhir' => 'required|in:lulus,tidak_lulus',
            'emisi_co' => 'nullable|numeric',
            'emisi_hc' => 'nullable|numeric',
            'rem_utama_kiri' => 'nullable|numeric',
            'rem_utama_kanan' => 'nullable|numeric',
        ]);

        // 1. Simpan ke tabel hasil_uji
        $hasil = new HasilUji();

        // Menggunakan fill() untuk mengambil semua data dari form Pos 1-5 
        // yang namanya sesuai dengan $fillable di Model HasilUji
        $hasil->fill($request->all());

        $hasil->pendaftaran_id = $id;
        $hasil->petugas_id = auth()->id();

        // Logika masa berlaku jika lulus
        if ($request->hasil_akhir == 'lulus') {
            $hasil->masa_berlaku_sampai = now()->addMonths(6); // Berlaku 6 bulan
        }

        $hasil->save();

        // 2. Update status di tabel pendaftaran
        $pendaftaran = PendaftaranUji::findOrFail($id);
        $pendaftaran->update([
            'status_uji' => $request->hasil_akhir == 'lulus' ? 'Lulus' : 'Tidak Lulus',
            'status_pos' => 5 // Tandai sudah melewati pos terakhir
        ]);

        // 3. Redirect dengan data session untuk memicu modal summary di View
        return redirect()->route('admin.hasil-uji.index')->with([
            'success' => 'Data hasil uji berhasil disimpan!',
            'show_summary' => true,
            'last_id' => $hasil->id,
            'hasil_akhir' => $hasil->hasil_akhir,
            'no_uji' => $pendaftaran->no_uji
        ]);
    }

    /**
     * Cetak PDF Hasil Uji
     */
    public function cetakPdf($id)
    {
        $data = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.cetak-hasil-pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        // Menggunakan stream agar terbuka di tab baru (blank page) jika dipanggil dengan target="_blank"
        return $pdf->stream('Hasil_Uji_' . ($data->pendaftaran->no_uji ?? $id) . '.pdf');
    }

    /**
     * Riwayat Hasil Uji dengan Filter
     */
    public function riwayat(Request $request)
    {
        $query = HasilUji::with(['pendaftaran.kendaraan', 'petugas']);

        // Filter Pencarian (No Uji atau No Kendaraan)
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('pendaftaran', function ($q) use ($search) {
                $q->where('no_uji', 'like', "%{$search}%")
                    ->orWhereHas('kendaraan', function ($qk) use ($search) {
                        $qk->where('no_kendaraan', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Berdasarkan Status Lulus/Tidak
        if ($request->filled('status')) {
            $query->where('hasil_akhir', $request->status);
        }

        $riwayat = $query->latest()->paginate(10);
        return view('admin.riwayat-uji', compact('riwayat'));
    }

    /**
     * Jika Anda masih membutuhkan halaman input manual terpisah
     */
    public function create($id)
    {
        $pendaftaran = PendaftaranUji::with('kendaraan')->findOrFail($id);
        return view('admin.hasil-uji-input', compact('pendaftaran'));
    }
}