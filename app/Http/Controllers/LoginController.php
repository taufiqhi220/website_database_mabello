<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi pengguna.
     */
    // LoginController
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'id_user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Log informasi untuk debugging
        Log::info('Percobaan login', ['id_user' => $credentials['id_user']]);

        // Cek pengguna di tabel 'users'
        $user = User::where('id_user', $credentials['id_user'])->first();

        // Periksa apakah pengguna ditemukan dan password cocok (menggunakan bcrypt hash)
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Login manual
            Auth::login($user);
            $request->session()->regenerate();

            // Log login berhasil
            Log::info('Login berhasil', ['user_id' => $user->id_user, 'posisi' => $user->posisi]);

            // Redirect berdasarkan posisi pengguna
            switch ($user->posisi) {
                case 'super administrator':
                    return redirect('/sadmin')->with('success', 'Login berhasil sebagai Super Administrator!');
                case 'administrator':
                    // Redirect ke halaman dashboard admin
                    return redirect()->route('admins.dashboard')->with('success', 'Login berhasil sebagai Administrator!');
                case 'distributor':
                    return redirect()->route('distributors.dashboard')->with('success', 'Login berhasil sebagai Distributor!');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['status' => 'Posisi pengguna tidak valid.']);
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'id_user' => 'ID pengguna atau password salah.',
        ])->onlyInput('id_user');
    }
    /**
     * Logout pengguna.
     */
    public function logout()
    {
        Auth::logout(); // Menghapus sesi pengguna
        return redirect('/login'); // Redirect ke halaman login
    }
}
