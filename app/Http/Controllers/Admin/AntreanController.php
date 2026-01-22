<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    public function index()
    {
        // Ubah nama variabel dari $antreanAktif menjadi $antrean
        $antrean = PendaftaranUji::with(['kendaraan.pemilik'])
            ->whereDate('tgl_daftar', today())
            ->whereIn('status_uji', ['menunggu', 'proses'])
            ->orderBy('nomor_antrean', 'asc')
            ->get();

        // Kirim dengan nama 'antrean'
        return view('admin.antrean', compact('antrean'));
    }

    // Perbaikan 2: Menggunakan Route Model Binding (PendaftaranUji $antrean)
    public function updateStatus(Request $request, $id)
    {
        $antrean = PendaftaranUji::findOrFail($id);

        // Maksimal Pos adalah 3
        if ($antrean->status_pos < 3) {
            $antrean->status_pos += 1;

            // Jika masuk ke jalur, status berubah jadi proses
            $antrean->status_uji = 'proses';

            $antrean->save();

            return redirect()->back()->with(
                'success',
                "Kendaraan {$antrean->kendaraan->no_kendaraan} berhasil dipindahkan ke Pos {$antrean->status_pos}"
            );
        }

        return redirect()->back()->with('info', 'Kendaraan sudah berada di tahap akhir jalur uji.');
    }
}