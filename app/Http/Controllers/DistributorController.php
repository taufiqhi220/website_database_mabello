<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\Auth;
use App\Models\ProdukMasukKeluar;

class DistributorController extends Controller
{
    /**
     * Menampilkan daftar distributor.
     */
    public function index()
    {
        $distributors = User::where('posisi', 'distributor')->get(); // Mendapatkan data distributor
        return view('pages.distributor.distributor', compact('distributors'));
    }


    public function produkkeluar()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Jika yang login adalah distributor, tampilkan hanya produk keluar yang sesuai dengan id_user sebagai distribution_center
        if ($user->posisi === 'distributor') {
            // Mengambil semua produk keluar yang berkaitan dengan distributor yang sedang login
            $produkKeluar = ProdukMasukKeluar::with('distributor')
                ->where('tipe_transaksi', 'keluar')
                ->where('distribution_center', $user->id_user) // Filter berdasarkan distribution_center
                ->get();
        } else {
            // Jika user adalah admin atau memiliki posisi selain distributor, tampilkan semua produk keluar
            $produkKeluar = ProdukMasukKeluar::with('distributor')
                ->where('tipe_transaksi', 'keluar')
                ->get();
        }

        return view('pages.distributor.produk-keluar', compact('produkKeluar'));
    }



    public function dashboard()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Masking the password by showing only asterisks (you can adjust this based on your needs)
        $maskedPassword = str_repeat('*', 8); // Atur jumlah asterisk sesuai kebutuhan

        // Hitung jumlah distributor
        $distributorCount = Distributor::count(); // Menghitung jumlah distributor

        // Mengirim data ke view dashboard
        return view('pages.distributor.dashboard', compact('user', 'distributorCount', 'maskedPassword'));
    }

    /**
     * Menampilkan form tambah distributor.
     */
    public function create()
    {
        return view('pages.distributor.create'); // Pastikan nama view sesuai struktur folder
    }

    /**
     * Menyimpan distributor baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'id_user' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:db_user,id_user|max:255',
            'nama' => 'required|string|max:255', // Validasi nama
            'password' => 'required|string|min:6',
        ]);

        // Menyimpan data distributor ke dalam database (password di-hash otomatis oleh model)
        User::create([
            'id_user' => $validated['id_user'],
            'nama' => $validated['nama'], // Tambahkan nama
            'password' => $validated['password'], // Di-hash otomatis oleh model
            'posisi' => 'distributor',
        ]);

        return redirect()->route('distributors.index')->with('success', 'Distributor berhasil ditambahkan.');
    }


    public function edit($id_user)
    {
        // Cari user berdasarkan ID yang diberikan
        $user = User::findOrFail($id_user);

        // Pengecekan apakah yang mengedit adalah Super Administrator
        if (Auth::user()->posisi !== 'super administrator') {
            // Jika yang mencoba mengedit bukan Super Administrator, redirect ke halaman yang sesuai
            return redirect()->route('distributors.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        // Jika yang mengedit adalah Super Administrator, tampilkan halaman edit
        return view('pages.distributor.edit', compact('user')); // Super Admin mengedit tampilan admin
    }
    
    /**
     * Memperbarui data distributor.
     */
    /**
 * Memperbarui data distributor.
 */
    public function update(Request $request, $id_user)
    {
        // Cari distributor berdasarkan ID user yang diberikan
        $user = User::findOrFail($id_user);

        // Validasi input tanpa validasi id_user yang unik
        $validated = $request->validate([
            'id_user' => 'required|string|max:255', // Tanpa validasi unik
            'nama' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Validasi password baru (opsional)
        ]);

        // Update data pengguna
        $user->id_user = $validated['id_user'];
        $user->nama = $validated['nama'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password']; // Di-hash otomatis oleh model cast
        }

        $user->save();

        return redirect()->route('distributors.index')->with('success', 'Profil berhasil diperbarui.');
    }



    /**
     * Menghapus distributor.
     */
    public function destroy($id_user)
    {
        // Cari distributor berdasarkan id_user
        $distributor = User::findOrFail($id_user); // Gunakan model User di sini, karena distribusi berada di tabel db_user
        $distributor->delete();

        return redirect()->route('distributors.index')->with('success', 'Distributor berhasil dihapus.');
    }
}
