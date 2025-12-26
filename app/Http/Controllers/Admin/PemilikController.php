<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemilik::query();

        // Fitur Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%$search%")
                    ->orWhere('nik', 'LIKE', "%$search%")
                    ->orWhere('no_hp', 'LIKE', "%$search%");
            });
        }

        // Fitur Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $pemiliks = $query->paginate(10)->withQueryString();

        return view('admin.pemilik', compact('pemiliks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pemilik,nik|digits:16',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
        ]);

        Pemilik::create($request->all());

        return redirect()->back()->with('success', 'Data pemilik berhasil ditambahkan!');
    }
}