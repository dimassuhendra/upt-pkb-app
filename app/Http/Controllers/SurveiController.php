<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUji;
use App\Models\RatingPelayanan; // Pastikan model Rating di-import
use App\Models\User;   // Berdasarkan file SQL Anda, petugas ada di tabel users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class SurveiController extends Controller
{
    public function index()
    {
        // Mencari kendaraan yang sudah selesai uji tapi belum memberi rating
        $antreanSurvei = PendaftaranUji::whereIn('status_uji', ['Lulus', 'Tidak Lulus'])
            ->whereDoesntHave('rating')
            ->with('kendaraan.pemilik')
            ->orderBy('tgl_daftar', 'asc')
            ->first();

        return view('survei.survei', compact('antreanSurvei'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'ratings' => 'required|array|size:6', 
            'ratings.*.skor' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // 2. Simpan setiap aspek layanan sebagai satu baris di tabel 'ratings'
            foreach ($request->ratings as $aspek => $data) {

                // Cari petugas yang bertugas di pos tersebut (opsional)
                // Jika Anda belum punya sistem mapping jadwal, petugas_id bisa dikosongkan dulu
                // atau diisi ID petugas yang memang bertugas di pos tersebut.

                DB::table('ratings')->insert([
                    'pendaftaran_id' => $request->pendaftaran_id,
                    'aspek_layanan' => $aspek, // administrasi, pos_1, dst
                    'skor_bintang' => $data['skor'],
                    // Kita simpan komentar hanya di baris 'administrasi' agar tidak duplikat
                    'komentar' => ($aspek == 'administrasi') ? $request->komentar : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('survei.survei')->with('success', 'Terima kasih! Penilaian Anda sangat berarti bagi kami.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
