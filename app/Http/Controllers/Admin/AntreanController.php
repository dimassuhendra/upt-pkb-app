<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    public function index()
    {
        $antreanAktif = PendaftaranUji::with(['kendaraan'])
            ->whereDate('tgl_daftar', today())
            ->whereIn('status_uji', ['menunggu', 'proses'])
            ->orderBy('nomor_antrean', 'asc')
            ->get();

        return view('admin.antrean', compact('antreanAktif'));
    }

    public function updateStatus(Request $request, $id)
    {
        $antrean = PendaftaranUji::findOrFail($id);

        // Logika sederhana untuk memajukan posisi pos
        if ($antrean->status_pos < 3) {
            $antrean->status_pos += 1;
            $antrean->status_uji = 'proses';

            if ($antrean->status_pos == 3) {
                $antrean->status_uji = 'selesai';
            }

            $antrean->save();
            return redirect()->back()->with('success', 'Kendaraan berhasil dipindahkan ke Pos ' . $antrean->status_pos);
        }

        return redirect()->back()->with('info', 'Kendaraan sudah menyelesaikan semua tahapan.');
    }
}