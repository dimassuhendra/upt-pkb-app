<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Tambahkan ini untuk validasi unik saat update

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Gunakan Eager Loading untuk mencegah N+1 Query
        $query = Kendaraan::with('pemilik');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) { // Bungkus dalam closure agar OR tidak merusak query lain
                $q->where('no_kendaraan', 'LIKE', "%$search%")
                    ->orWhere('no_rangka', 'LIKE', "%$search%")
                    ->orWhere('no_mesin', 'LIKE', "%$search%")
                    ->orWhereHas('pemilik', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'LIKE', "%$search%");
                    });
            });
        }

        // 2. Validasi kolom sort agar tidak terjadi SQL Error jika user iseng mengubah URL
        $allowedSort = ['created_at', 'no_kendaraan', 'merek', 'masa_berlaku_uji_kir'];
        $sortBy = in_array($request->get('sort_by'), $allowedSort) ? $request->get('sort_by') : 'created_at';
        $sortOrder = $request->get('sort_order') === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sortBy, $sortOrder);

        $optBahanBakar = ['Solar', 'Bensin', 'Gas', 'Listrik'];
        $optJenis = ['Mobil Penumpang', 'Mobil Bus', 'Mobil Barang', 'Kereta Gandengan', 'Kereta Tempelan'];

        $kendaraans = $query->paginate(10)->withQueryString();
        $pemiliks = Pemilik::orderBy('nama_lengkap', 'asc')->get();

        return view('admin.kendaraan', compact('kendaraans', 'pemiliks', 'optBahanBakar', 'optJenis'));
    }

    public function store(Request $request)
    {
        // 3. Tambahkan validasi untuk semua field penting
        $request->validate([
            'pemilik_id' => 'required|exists:pemilik,id',
            'no_kendaraan' => 'required|string|max:15|unique:kendaraan,no_kendaraan',
            'no_rangka' => 'required|string|unique:kendaraan,no_rangka',
            'no_mesin' => 'nullable|string',
            'masa_berlaku_uji_kir' => 'nullable|date',
            'bahan_bakar' => [
                'required',
                Rule::in(['Solar', 'Bensin', 'Gas', 'Listrik']),
            ],
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Mobil Penumpang', 'Mobil Bus', 'Mobil Barang', 'Kereta Gandengan', 'Kereta Tempelan']),
            ],
        ]);

        Kendaraan::create($request->all());
        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        // 4. Validasi UNIK saat update (agar tidak bentrok dengan data lain tapi boleh sama dengan dirinya sendiri)
        $request->validate([
            'pemilik_id' => 'required|exists:pemilik,id',
            'no_kendaraan' => [
                'required',
                Rule::unique('kendaraan')->ignore($kendaraan->id),
            ],
            'no_rangka' => [
                'required',
                Rule::unique('kendaraan')->ignore($kendaraan->id),
            ],
            'masa_berlaku_uji_kir' => 'nullable|date',
        ]);

        $kendaraan->update($request->all());
        return redirect()->back()->with('success', 'Data kendaraan diperbarui');
    }

    public function destroy($id)
    {
        // 5. Tambahkan pencegahan jika kendaraan sedang dalam proses pendaftaran aktif (Opsional tapi disarankan)
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->back()->with('success', 'Data kendaraan dihapus');
    }
}