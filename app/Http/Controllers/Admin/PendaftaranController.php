<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use App\Models\Kendaraan;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function create()
    {
        // Ambil data kendaraan untuk dropdown (bisa dikembangkan dengan search/select2)
        $kendaraan = Kendaraan::all();
        return view('admin.pendaftaran', compact('kendaraan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required',
            'jenis_pendaftaran' => 'required',
            'total_biaya' => 'required|numeric',
        ]);

        $today = Carbon::today();

        // Generate Nomor Antrean (Contoh: 001, 002 dst berdasarkan hari ini)
        $countToday = PendaftaranUji::whereDate('tgl_daftar', $today)->count();
        $nomorAntrean = str_pad($countToday + 1, 3, '0', STR_PAD_LEFT);

        // Generate Kode Pendaftaran Unik
        $kodePendaftaran = 'REG-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        PendaftaranUji::create([
            'kendaraan_id' => $request->kendaraan_id,
            'petugas_id' => auth()->id(), // Admin yang mendaftarkan
            'kode_pendaftaran' => $kodePendaftaran,
            'tgl_daftar' => $today,
            'nomor_antrean' => $nomorAntrean,
            'jenis_pendaftaran' => $request->jenis_pendaftaran,
            'total_biaya' => $request->total_biaya,
            'status_pembayaran' => 'lunas', // Asumsi langsung bayar di loket
            'status_uji' => 'menunggu', // Belum masuk pos 1
            'status_pos' => 0, // 0 berarti baru daftar, belum masuk jalur uji
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pendaftaran berhasil! Antrean: ' . $nomorAntrean);
    }
}