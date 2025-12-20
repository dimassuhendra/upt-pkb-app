<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Mengambil semua kendaraan untuk pilihan di form (dropdown)
        $kendaraans = Kendaraan::with('pemilik')->get();

        // Antrean tetap menggunakan with('kendaraan.pemilik') seperti yang sudah Anda buat
        $antrean = PendaftaranUji::with('kendaraan.pemilik')
            ->whereDate('tgl_uji', Carbon::today())
            ->orderBy('nomor_antrean', 'asc')
            ->get();

        return view('admin.pendaftaran', compact('kendaraans', 'antrean'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
        ]);

        // 1. Ambil data kendaraan untuk cek jenisnya
        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        // 2. Logika Penentuan biaya_retribusi (Sesuai dengan yang ada di Blade)
        $biaya_retribusi = 100000; // Default
        if ($kendaraan->jenis_kendaraan == 'Truk') {
            $biaya_retribusi = 150000;
        } elseif ($kendaraan->jenis_kendaraan == 'Bus') {
            $biaya_retribusi = 200000;
        }

        // 3. Generate Nomor Antrean
        $lastAntrean = PendaftaranUji::whereDate('tgl_uji', now())->max('nomor_antrean');
        $newAntrean = $lastAntrean ? $lastAntrean + 1 : 1;

        // 4. Simpan ke Database
        PendaftaranUji::create([
            'kendaraan_id' => $request->kendaraan_id,
            'tgl_uji' => now(),
            'nomor_antrean' => $newAntrean,
            'status_kelulusan' => 'proses',
            'biaya_retribusi' => $biaya_retribusi, // Simpan biaya_retribusi ke database
        ]);

        return redirect()->back()->with('success', 'Pendaftaran Berhasil! Nomor Antrean: #' . $newAntrean);
    }
}