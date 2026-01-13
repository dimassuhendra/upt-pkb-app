<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntreanController extends Controller
{
    public function index(Request $request)
    {
        $today = \Carbon\Carbon::today();
        $posPetugas = auth()->user()->pos_tugas;

        // Mapping kolom kunci: Jika kolom ini tidak NULL, berarti antrean untuk pos tersebut dianggap selesai
        $mappingKolom = [
            'Pos 1' => 'kondisi_ban',          // Mewakili pemeriksaan Visual
            'Pos 2' => 'emisi_co',             // Mewakili pemeriksaan Emisi
            'Pos 3' => 'rem_utama_kiri',       // Mewakili pemeriksaan Rem
            'Pos 4' => 'lampu_utama_kekuatan', // Mewakili pemeriksaan Lampu
            'Pos 5' => 'side_slip',            // Mewakili pemeriksaan Roda/Sumbu
        ];

        $query = \App\Models\PendaftaranUji::with('kendaraan')
            ->whereDate('tgl_daftar', $today)
            ->where('status_uji', '!=', 'selesai');

        // Filter: Hanya tampilkan yang BELUM memiliki data di kolom kunci pos tersebut
        if (isset($mappingKolom[$posPetugas])) {
            $kolom = $mappingKolom[$posPetugas];
            $query->whereDoesntHave('hasil', function ($q) use ($kolom) {
                $q->whereNotNull($kolom);
            });
        }

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('kode_pendaftaran', 'like', "%{$search}%")
                    ->orWhereHas('kendaraan', function ($qk) use ($search) {
                        $qk->where('no_kendaraan', 'like', "%{$search}%");
                    });
            });
        }

        $antrean = $query->orderBy('nomor_antrean', 'asc')->get();

        return view('petugas.antrean', compact('antrean'));
    }
}