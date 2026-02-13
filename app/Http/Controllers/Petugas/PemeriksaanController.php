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
        $pendaftaran = PendaftaranUji::with('kendaraan')->findOrFail($id);
        $hasil = HasilUji::where('pendaftaran_id', $id)->first();
        $posPetugas = auth()->user()->pos_tugas;

        // Mapping kolom yang sama dengan di AntreanController
        $mappingKolom = [
            'Pos 1' => 'kondisi_ban',
            'Pos 2' => 'emisi_co',
            'Pos 3' => 'rem_utama_kiri',
            'Pos 4' => 'lampu_utama_kekuatan',
            'Pos 5' => 'side_slip',
        ];

        // Cek jika data sudah ada untuk pos ini, langsung tendang keluar
        if ($hasil && isset($mappingKolom[$posPetugas])) {
            $kolom = $mappingKolom[$posPetugas];
            if (!empty($hasil->$kolom)) {
                return redirect()->route('petugas.antrean')
                    ->with('error', 'Kendaraan ini sudah selesai diperiksa di ' . $posPetugas);
            }
        }

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
        // Validasi tambahan untuk Pos 5
        if (Auth::user()->pos_tugas == 'Pos 5') {
            $request->validate([
                'hasil_akhir' => 'required',
                'side_slip' => 'required',
                // Pastikan string 'lulus' sesuai dengan value di database (kecil semua)
                'masa_berlaku_sampai' => 'required_if:hasil_akhir,lulus',
            ]);
        }

        try {
            DB::beginTransaction();

            $data = $request->except(['_token']);
            $data['pendaftaran_id'] = $id;
            $data['petugas_id'] = Auth::id();

            // Normalisasi data hasil_akhir agar sesuai enum database ('lulus'/'tidak_lulus')
            if (isset($data['hasil_akhir'])) {
                $data['hasil_akhir'] = strtolower(str_replace(' ', '_', $data['hasil_akhir']));
            }

            if ($request->hasil_akhir == 'Tidak Lulus') {
                $data['masa_berlaku_sampai'] = null;
            }

            // 1. Simpan atau Update ke tabel hasil_uji
            HasilUji::updateOrCreate(
                ['pendaftaran_id' => $id],
                $data
            );

            $posPetugas = Auth::user()->pos_tugas;

            // 2. LOGIKA UPDATE TABEL KENDARAAN (Hanya jika di Pos 5 dan Lulus)
            if ($posPetugas == 'Pos 5' && strtolower($request->hasil_akhir) == 'lulus') {
                $pendaftaran = PendaftaranUji::with('kendaraan')->findOrFail($id);

                if ($pendaftaran->kendaraan) {
                    // Update kolom masa_berlaku_uji_kir di tabel kendaraan
                    $pendaftaran->kendaraan->update([
                        'masa_berlaku_uji_kir' => $request->masa_berlaku_sampai
                    ]);
                }
            }

            // 3. Update Status di Tabel Pendaftaran
            $status = ($posPetugas == 'Pos 5') ? 'Lulus' : 'Proses';
            PendaftaranUji::where('id', $id)->update(['status_uji' => $status]);

            DB::commit();
            return redirect()->route('petugas.antrean')->with('success', 'Data berhasil disimpan dan masa berlaku KIR diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Gagal simpan: " . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage())->withInput();
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
