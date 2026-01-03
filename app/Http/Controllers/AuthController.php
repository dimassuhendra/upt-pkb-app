<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // --- LOGIN ADMIN ---
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$fieldType => $request->username, 'password' => $request->password];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Logika Redirect Ketat untuk Admin
            if (in_array($user->role, ['super_admin', 'admin_pendaftaran'])) {
                return redirect('/admin/dashboard')->with('success', 'Selamat Datang, Admin!');
            }

            // Jika role bukan admin tapi login di sini, alihkan ke tempat yang benar
            return $this->redirectByRole($user->role);
        }

        return back()->withErrors(['username' => 'Kredensial Admin tidak valid.'])->onlyInput('username');
    }

    // --- LOGIN PETUGAS ---
    public function showPetugasLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.login-petugas');
    }

    public function petugasLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$fieldType => $request->username, 'password' => $request->password];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Logika Redirect Ketat untuk Petugas
            if ($user->role === 'petugas') {
                return redirect('/petugas/dashboard')->with('success', 'Selamat Bertugas, Petugas!');
            }

            // Jika admin nyasar login di petugas, arahkan ke admin
            return $this->redirectByRole($user->role);
        }

        return back()->withErrors(['username' => 'Kredensial Petugas tidak valid.'])->onlyInput('username');
    }

    /**
     * Helper untuk keamanan agar user diarahkan ke dashboard yang tepat
     * Menggunakan redirect path langsung untuk menghindari konflik session 'intended'
     */
    protected function redirectByRole($role)
    {
        if (in_array($role, ['super_admin', 'admin_pendaftaran'])) {
            return redirect('/admin/dashboard');
        } elseif ($role === 'petugas') {
            return redirect('/petugas/dashboard');
        }

        Auth::logout();
        return redirect('/')->with('error', 'Role tidak dikenali.');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        // Simpan role sebelum session dihancurkan untuk menentukan halaman redirect
        $role = Auth::check() ? Auth::user()->role : null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect kembali ke halaman login yang sesuai
        if ($role === 'petugas') {
            return redirect()->route('petugas.login')->with('success', 'Sesi petugas berakhir.');
        }

        return redirect('/login-admin')->with('success', 'Sesi admin berakhir.');
    }
}