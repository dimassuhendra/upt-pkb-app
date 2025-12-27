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
        $today = Carbon::today();
        
        // Query dasar: Ambil pendaftaran hari ini yang belum selesai ujinya
        $query = PendaftaranUji::with('kendaraan')
            ->whereDate('tgl_daftar', $today)
            ->where('status_uji', '!=', 'selesai');

        // Fitur Pencarian berdasarkan No Uji atau Plat
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('kode_pendaftaran', 'like', "%{$search}%")
                  ->orWhereHas('kendaraan', function($qk) use ($search) {
                      $qk->where('no_kendaraan', 'like', "%{$search}%");
                  });
            });
        }

        $antrean = $query->orderBy('nomor_antrean', 'asc')->get();

        return view('petugas.antrean', compact('antrean'));
    }
}