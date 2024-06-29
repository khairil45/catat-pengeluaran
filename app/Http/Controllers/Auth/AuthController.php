<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan halaman login admin
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login-user');
    }

    // Method untuk memproses login admin
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name'     => ['required'],
            'password' => ['required'],
        ]);

        // Coba melakukan autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect ke halaman admin jika peran pengguna adalah admin
            if ($user->hasRole('admin')) {
                return redirect('track-expenses/admin');
            }

            // Redirect ke halaman pengguna jika peran pengguna adalah user
            if ($user->hasRole('user')) {
                return redirect('track-expenses');
            }
        }

        // Redirect ke halaman login dengan pesan kesalahan jika autentikasi gagal
        return redirect('login')->with('errors', 'Username atau password tidak valid. Silakan coba lagi.');
    }

    // Method untuk proses logout admin dan pengguna
    public function destroy(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Mematikan sesi pengguna
        $request->session()->invalidate();

        // Membuat token sesi baru
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('login');
    }
}
