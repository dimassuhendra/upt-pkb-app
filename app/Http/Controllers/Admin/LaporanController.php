<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilUji;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default rentang waktu: bulan ini
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Ambil data dalam rentang tanggal
        $data = HasilUji::whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->with(['pendaftaran.kendaraan'])
            ->get();

        // Statistik Ringkas
        $stats = [
            'total' => $data->count(),
            'lulus' => $data->where('hasil_akhir', 'lulus')->count(),
            'gagal' => $data->where('hasil_akhir', 'tidak_lulus')->count(),
        ];

        return view('admin.laporan-periodik', compact('data', 'stats', 'startDate', 'endDate'));
    }
}