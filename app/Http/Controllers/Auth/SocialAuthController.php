<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Redirect ke halaman autentikasi sosial Google.
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari autentikasi sosial Google.
    public function callback()
    {
        // Ambil data pengguna dari Google
        $googleUser = Socialite::driver('google')->user();

        // Cari pengguna termasuk yang terhapus (soft deleted)
        $existingUser = User::withTrashed()->where('email', $googleUser->email)->first();

        if ($existingUser && $existingUser->trashed()) {
            // Jika pengguna ditemukan dalam keadaan soft deleted, pulihkan pengguna
            $existingUser->restore();

            // Update data pengguna dengan data dari Google
            $existingUser->update([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'avatar' => $googleUser->avatar,
            ]);

            // Tambahkan peran pengguna sebagai 'user' jika belum ada
            if (!$existingUser->hasRole('user')) {
                $existingUser->assignRole('user');
            }

            // Login pengguna
            Auth::login($existingUser);

            // Redirect ke halaman pengguna
            return redirect('track-expenses');
        } elseif (!$existingUser) {
            // Jika pengguna tidak ditemukan, buat pengguna baru dari data Google
            $user = User::create([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'password' => Hash::make('12345'),
                'avatar' => $googleUser->avatar,
            ]);

            // Tambahkan peran pengguna sebagai 'user'
            $user->assignRole('user');

            // Login pengguna
            Auth::login($user);

            // Redirect ke halaman pengguna
            return redirect('track-expenses');
        } else {
            // Jika pengguna ditemukan dan tidak dalam keadaan soft deleted, langsung login pengguna
            Auth::login($existingUser);

            // Redirect ke halaman pengguna
            return redirect('track-expenses');
        }
    }
}
