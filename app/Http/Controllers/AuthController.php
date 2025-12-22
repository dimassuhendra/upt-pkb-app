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

            // Pastikan yang login di sini adalah Admin
            if (in_array(Auth::user()->role, ['super_admin', 'admin_pendaftaran'])) {
                return redirect()->intended('admin/dashboard')->with('success', 'Halo Admin!');
            }

            // Jika role petugas nyasar ke login admin, paksa logout atau alihkan
            return $this->redirectByRole(Auth::user()->role);
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

            // Pastikan yang login adalah Petugas
            if (Auth::user()->role === 'petugas') {
                return redirect()->intended('petugas/dashboard')->with('success', 'Halo Petugas!');
            }

            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->withErrors(['username' => 'Kredensial Petugas tidak valid.'])->onlyInput('username');
    }

    // Helper untuk keamanan agar user tidak salah kamar
    protected function redirectByRole($role)
    {
        if (in_array($role, ['super_admin', 'admin_pendaftaran'])) {
            return redirect()->intended('admin/dashboard');
        } elseif ($role === 'petugas') {
            return redirect()->intended('petugas/dashboard');
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}