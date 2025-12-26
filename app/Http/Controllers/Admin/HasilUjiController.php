<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilUji;
use Illuminate\Http\Request;
use Illuminate\Http\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan sudah install dompdf


class HasilUjiController extends Controller
{
    public function hasil_uji()
    {
        // Mengambil data hasil uji beserta relasi pendaftaran dan kendaraan
        $rekap = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])->latest()->get();
        return view('admin.hasil-uji', compact('rekap'));
    }

    public function cetakPdf($id)
    {
        $data = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])->findOrFail($id);

        // Load view khusus untuk format kertas print
        $pdf = Pdf::loadView('admin.cetak-hasil-pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Hasil_Uji_' . $data->pendaftaran->no_uji . '.pdf');
    }

    public function riwayat(Request $request)
    {
        $query = HasilUji::with(['pendaftaran.kendaraan', 'petugas']);

        // Filter Pencarian
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('pendaftaran', function ($q) use ($search) {
                $q->where('no_uji', 'like', "%{$search}%")
                    ->orWhereHas('kendaraan', function ($qk) use ($search) {
                        $qk->where('no_kendaraan', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Berdasarkan Hasil
        if ($request->filled('status')) {
            $query->where('hasil_akhir', $request->status);
        }

        $riwayat = $query->latest()->paginate(10); // Gunakan pagination agar tidak berat
        return view('admin.riwayat-uji', compact('riwayat'));
    }
}
