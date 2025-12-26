<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        }

        $petugas = $query->where('id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.petugas', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:super_admin,admin_pendaftaran,petugas',
            'pos_tugas' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'pos_tugas' => $request->role === 'petugas' ? $request->pos_tugas : null,
            'is_active' => 1,
        ]);

        return redirect()->back()->with('success', 'Akun petugas berhasil dibuat.');
    }

    // Tambahkan fungsi update posisi pos secara cepat
    public function updatePos(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['pos_tugas' => $request->pos_tugas]);

        return redirect()->back()->with('success', 'Posisi tugas ' . $user->name . ' berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun petugas berhasil $status.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun petugas berhasil dihapus permanen.');
    }
}