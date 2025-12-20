<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika admin sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->intended('admin/dashboard');
        }
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Cek apakah input berupa email atau username biasa
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $loginData = [
            $fieldType => $request->username,
            'password' => $request->password
        ];

        // Eksekusi Login dengan fitur "Remember Me"
        if (Auth::attempt($loginData, $request->has('remember'))) {
            $request->session()->regenerate();

            // Redirect ke halaman yang dituju sebelumnya atau ke dashboard
            return redirect()->intended('admin/dashboard')
                ->with('success', 'Selamat datang kembali, Admin!');
        }

        // Jika gagal, kembali dengan pesan error
        return back()->withErrors([
            'username' => 'Kredensial yang Anda berikan tidak cocok dengan data kami.',
        ])->onlyInput('username');
    }

    // Menangani Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('info', 'Anda telah berhasil keluar sistem.');
    }
}