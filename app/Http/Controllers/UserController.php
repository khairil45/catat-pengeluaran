<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan dashboard pengguna.
    public function dashboard()
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = Auth::user();

        // Menghitung total expense hari ini
        $todayTransactions = $user->expenses()
            ->whereDate('date', Carbon::today())
            ->sum('amount');

        // Menghitung total expense bulan ini
        $monthTransactions = $user->expenses()
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('amount');

        // Menampilkan halaman dashboard pengguna dengan data total expense hari ini dan bulan ini
        return view('users.dashboard', compact('todayTransactions', 'monthTransactions'));
    }

    // Menampilkan profil pengguna.
    public function show(string $slug)
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = Auth::user();

        // Mengambil data pengguna berdasarkan slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Menampilkan halaman profil pengguna dengan data pengguna
        $view_data = ([
            'user' => $user
        ]);

        return view('users.profile.show', $view_data);
    }

    // Menghapus akun pengguna.
    public function destroy(string $slug)
    {
        // Menghapus akun pengguna berdasarkan slug
        User::where('slug', $slug)
            ->delete();

        // Redirect ke halaman login
        return redirect('login');
    }
}
