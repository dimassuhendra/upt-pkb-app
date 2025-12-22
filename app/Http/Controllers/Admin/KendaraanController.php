<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        // Menggunakan with('pemilik') agar tidak terjadi N+1 query (Eager Loading)
        $kendaraans = Kendaraan::with('pemilik')->orderBy('created_at', 'desc')->get();
        $pemiliks = Pemilik::orderBy('nama_lengkap', 'asc')->get();

        return view('admin.data-kendaraan', compact('kendaraans', 'pemiliks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemilik_id' => 'required|exists:pemilik,id',
            'no_kendaraan' => 'required|string|unique:kendaraan,no_kendaraan',
            'jenis_kendaraan' => 'required',
            'merek' => 'required',
            'tahun_pembuatan' => 'required|numeric',
        ]);

        Kendaraan::create($request->all());
        return redirect()->back()->with('success', 'Kendaraan berhasil didaftarkan.');
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'pemilik_id' => 'required|exists:pemilik,id',
            'no_kendaraan' => 'required|string|unique:kendaraan,no_kendaraan,' . $id,
            'jenis_kendaraan' => 'required',
            'merek' => 'required',
            'tahun_pembuatan' => 'required|numeric',
        ]);

        $kendaraan->update($request->all());
        return redirect()->back()->with('success', 'Data kendaraan diperbarui.');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();
        return redirect()->back()->with('success', 'Kendaraan berhasil dihapus.');
    }
}