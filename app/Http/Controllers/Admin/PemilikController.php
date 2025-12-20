<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::orderBy('created_at', 'desc')->get();
        return view('admin.pemilik', compact('pemiliks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:pemilik,nik',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        Pemilik::create($request->all());
        return redirect()->back()->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:pemilik,nik,' . $id,
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        $pemilik->update($request->all());
        return redirect()->back()->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);

        // Cek jika pemilik masih memiliki kendaraan (Opsional untuk keamanan data)
        if ($pemilik->kendaraan()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus! Pemilik ini masih memiliki kendaraan terdaftar.');
        }

        $pemilik->delete();
        return redirect()->back()->with('success', 'Data pemilik berhasil dihapus.');
    }
}