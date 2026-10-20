<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar admin dengan posisi 'administrator'.
     */
    public function index()
    {
        $admins = User::where('posisi', 'administrator')->get();
        return view('pages.admin.admin', compact('admins'));
    }

    /**
     * Menampilkan dashboard admin.
     */
    public function dashboard()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Masking the password by showing only asterisks (you can adjust this based on your needs)
        $maskedPassword = str_repeat('*', 8); // Atur jumlah asterisk sesuai kebutuhan

        // Hitung jumlah admin dengan posisi 'administrator'
        $adminCount = User::where('posisi', 'administrator')->count();

        // Mengirim data ke view
        return view('pages.admin.dashboard', compact('user', 'adminCount', 'maskedPassword'));
    }

    /**
     * Menampilkan form untuk menambah admin.
     */
    public function create()
    {
        return view('pages.admin.create');
    }

    /**
     * Menyimpan data admin baru.
     */
    function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string|unique:db_user,id_user',
            'nama' => 'required|string',
            'password' => 'required|string|min:6|confirmed', // Pastikan password terkonfirmasi
        ]);

        // Password akan di-hash secara otomatis oleh model cast
        User::create([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'password' => $request->password, // Di-hash otomatis oleh model
            'posisi' => 'administrator',
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit admin yang sedang login.
     */
    public function edit($id)
    {
        // Ambil data admin berdasarkan ID yang diberikan
        $user = User::findOrFail($id); 
        return view('pages.admin.edit', compact('user'));
    }


    /**
     * Memperbarui data admin.
     */
    // Memperbarui data admin dengan password yang di-hash
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $validated = $request->validate([
            'id_user' => 'required|string|unique:db_user,id_user,' . $id . ',id_user', // Memastikan id_user (username) unik dan tidak terduplikasi
            'nama' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',  // Password boleh kosong, jika diisi maka validasi konfirmasi juga diperlukan
        ]);

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data admin
        $user->id_user = $request->input('id_user');  // Update id_user (username)
        $user->nama = $request->input('nama');  // Update nama

        // Periksa jika password diisi (hashing otomatis via model cast)
        if ($request->filled('password')) {
            $user->password = $request->input('password');  // Di-hash otomatis oleh model
        }

        $user->save();

        // Redirect kembali ke halaman admin setelah berhasil update
        return redirect()->route('admins.index')->with('success', 'Data admin berhasil diperbarui!');
    }




    /**
     * Menghapus data admin berdasarkan ID.
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus.');
    }
}
