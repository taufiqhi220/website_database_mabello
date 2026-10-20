<?php

namespace App\Http\Controllers;

use App\Models\ProdukMasukKeluar;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;

class ProdukKeluarController extends Controller
{
    // Menampilkan halaman produk keluar
    public function index()
    {
        // Mengambil semua produk dengan tipe transaksi 'keluar'
        $produkKeluar = ProdukMasukKeluar::where('tipe_transaksi', 'keluar')->get();
        return view('pages.produk-keluar.index', compact('produkKeluar'));
    }

    public function create()
    {
        $distributors = User::where('posisi', 'distributor')->get(); // Ambil hanya distributor
        $produk = Produk::all(); // Data produk
        return view('pages.produk-keluar.create', compact('distributors', 'produk'));
    }


    // Menyimpan data produk keluar
    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string',
        'tanggal_keluar' => 'required|date',
        'nomor_batch_exp' => 'required|string',
        'distribution_center' => 'required|exists:db_user,id_user', // Validasi relasi
        'jumlah' => 'required|integer|min:1',
    ]);

    ProdukMasukKeluar::create([
        'nama_produk' => $request->nama_produk,
        'tanggal_keluar' => $request->tanggal_keluar,
        'nomor_batch_exp' => $request->nomor_batch_exp,
        'distribution_center' => $request->distribution_center,
        'jumlah' => $request->jumlah,
        'tipe_transaksi' => 'keluar',
    ]);

    return redirect()->route('produkkeluar.index')->with('success', 'Produk keluar berhasil ditambahkan.');
}


    // Menghapus data produk keluar
    public function destroy($id)
    {
        // Menemukan produk keluar berdasarkan ID
        $produkKeluar = ProdukMasukKeluar::findOrFail($id);
        $produkKeluar->delete();

        // Redirect kembali ke halaman daftar produk keluar dengan pesan sukses
        return redirect()->route('produkkeluar.index')->with('success', 'Data produk keluar berhasil dihapus.');
    }
}
