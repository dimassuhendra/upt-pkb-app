<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilUji;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    // Fungsi pembantu untuk memanggil view berdasarkan nama file
    private function showForm($id, $viewName)
    {
        // Gunakan with('kendaraan') agar tidak N+1 query
        $pendaftaran = PendaftaranUji::with('kendaraan')->findOrFail($id);

        // Ambil hasil uji jika sudah ada (untuk keperluan edit atau melihat data pos sebelumnya)
        $hasil = HasilUji::where('pendaftaran_id', $id)->first();

        return view('petugas.pemeriksaan.' . $viewName, compact('pendaftaran', 'hasil'));
    }

    public function visualIndex($id)
    {
        return $this->showForm($id, 'visual');
    }
    public function emisiIndex($id)
    {
        return $this->showForm($id, 'emisi');
    }
    public function remIndex($id)
    {
        return $this->showForm($id, 'rem');
    }
    public function lampuIndex($id)
    {
        return $this->showForm($id, 'lampu');
    }
    public function rodaIndex($id)
    {
        return $this->showForm($id, 'roda');
    }

    public function store(Request $request, $id)
    {
        // 1. Validasi Dasar (Mencegah input kosong yang fatal)
        // Anda bisa menambahkan validasi spesifik tiap pos di sini jika perlu

        try {
            DB::beginTransaction();

            $data = $request->except(['_token']);
            $data['pendaftaran_id'] = $id;

            // Catat ID petugas terakhir yang melakukan update
            $data['petugas_id'] = Auth::id();

            // 2. UpdateOrCreate agar data tertumpuk di baris yang sama (1 kendaraan = 1 baris hasil)
            HasilUji::updateOrCreate(
                ['pendaftaran_id' => $id],
                $data
            );

            // 3. Logika Update Status Pendaftaran
            $posPetugas = Auth::user()->pos_tugas;

            // Jika Pos 5, anggap selesai. Jika pos lain, set ke 'proses'
            $status = ($posPetugas == 'Pos 5') ? 'selesai' : 'proses';

            PendaftaranUji::where('id', $id)->update(['status_uji' => $status]);

            DB::commit();
            return redirect()->route('petugas.antrean')->with('success', 'Data ' . $posPetugas . ' berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function riwayat()
    {
        $user = Auth::user();

        // Mengambil riwayat pemeriksaan yang melibatkan petugas ini
        // Menggunakan pagination agar loading tidak berat jika data sudah ribuan
        $riwayat = HasilUji::with(['pendaftaran.kendaraan'])
            ->where('petugas_id', $user->id)
            ->latest('updated_at')
            ->paginate(10);

        return view('petugas.riwayat', compact('riwayat'));
    }

    public function show($id)
    {
        // Menggunakan pendaftaran_id karena ini adalah relasi utama di view detail
        $hasil = HasilUji::with(['pendaftaran.kendaraan', 'petugas'])
            ->where('pendaftaran_id', $id)
            ->firstOrFail();

        return view('petugas.pemeriksaan.detail', compact('hasil'));
    }
}