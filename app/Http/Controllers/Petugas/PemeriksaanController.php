<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilUji;
use App\Models\PendaftaranUji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function showForm($id, $viewName)
    {
        $pendaftaran = PendaftaranUji::with('kendaraan')->findOrFail($id);
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
        $data = $request->except(['_token']);
        $data['pendaftaran_id'] = $id;
        $data['petugas_id'] = Auth::id();

        HasilUji::updateOrCreate(
            ['pendaftaran_id' => $id],
            $data
        );

        $status = (Auth::user()->pos_tugas == 'Pos 5') ? 'selesai' : 'proses';
        PendaftaranUji::where('id', $id)->update(['status_uji' => $status]);

        return redirect()->route('petugas.antrean')->with('success', 'Data pemeriksaan berhasil disimpan!');
    }

    public function riwayat()
    {
        $user = Auth::user();

        $riwayat = HasilUji::with(['pendaftaran.kendaraan'])
            ->where('petugas_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('petugas.riwayat', compact('riwayat'));
    }

    public function show($id)
    {
        $hasil = HasilUji::with(['pendaftaran.kendaraan'])->where('pendaftaran_id', $id)->firstOrFail();
        return view('petugas.pemeriksaan.detail', compact('hasil'));
    }
}