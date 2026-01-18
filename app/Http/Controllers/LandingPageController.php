<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LandingPageController extends Controller
{
    public function index()
    {
        $title = "UPT PKB Kota Bandar Lampung";

        return view('survei.index', compact('title'));
    }

    public function cekMasaBerlaku(Request $request)
    {
        $request->validate([
            'no_kendaraan' => 'required|string',
        ]);

        // Mencari kendaraan berdasarkan nomor kendaraan
        $kendaraan = DB::table('kendaraan')
            ->where('no_kendaraan', $request->no_kendaraan)
            ->first();

        if (!$kendaraan) {
            return back()->with('error', 'Data kendaraan tidak tersedia. Lakukan uji KIR terlebih dahulu.');
        }

        return back()->with('hasil', $kendaraan);
    }
}