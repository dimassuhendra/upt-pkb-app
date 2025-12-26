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
}
