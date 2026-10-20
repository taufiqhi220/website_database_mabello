<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Menampilkan halaman Super Admin.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Password sudah di-hash, tampilkan asterisk saja untuk keamanan
        $maskedPassword = str_repeat('*', 8);

        return view('pages.superadmin.sadmin', compact('user', 'maskedPassword')); // Kirim data pengguna dan password yang sudah diproses ke view
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function editProfile()
    {
        $user = Auth::user();  // Mengambil data pengguna yang sedang login
        return view('pages.superadmin.edit', compact('user'));  // Kirim data pengguna ke view edit.blade.php
    }

    /**
     * Mengupdate profil pengguna.
     */
    public function updateProfile(Request $request)
    {
    $user = Auth::user();

    // Validasi data input
    $validatedData = $request->validate([
        'id_user' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
    ], [
        'password.min' => 'Kata sandi harus memiliki setidaknya 6 karakter.', // Pesan kustom
    ]);

    // Update data pengguna
    $user->id_user = $validatedData['id_user'];
    $user->nama = $validatedData['nama'];

    // Perbarui password jika diisi (hashing otomatis via model cast)
    if ($request->filled('password')) {
        $user->password = $validatedData['password'];
    }

    // Simpan perubahan dan set flash message
    if ($user->save()) {
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    } else {
        return redirect()->route('profile.edit')->with('error', 'Gagal memperbarui profil.');
    }
    }

}

