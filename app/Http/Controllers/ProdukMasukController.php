<?php

namespace App\Http\Controllers;

use App\Models\ProdukMasukKeluar;
use Illuminate\Http\Request;
use App\Models\Produk; // Import model Produk

class ProdukMasukController extends Controller
{
    // Menampilkan halaman produk masuk
    public function index()
    {
        $produkMasuk = ProdukMasukKeluar::where('tipe_transaksi', 'masuk')->get(); // Mengambil produk dengan tipe transaksi 'masuk'
        return view('pages.produk-masuk.index', compact('produkMasuk'));
    }

    public function create()
    {
        $produk = Produk::all(); // Ambil semua data produk dari tabel Produk
        return view('pages.produk-masuk.create', compact('produk'));
    }

    // Menyimpan data produk masuk
    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string',
        'tanggal_masuk' => 'required|date',
        'nomor_batch_exp' => 'required|string',
        'jumlah' => 'required|integer|min:1',
    ]);

    ProdukMasukKeluar::create([
        'nama_produk' => $request->nama_produk,
        'tanggal_masuk' => $request->tanggal_masuk,
        'nomor_batch_exp' => $request->nomor_batch_exp,
        'jumlah' => $request->jumlah,
        'tipe_transaksi' => 'masuk', // Menandakan transaksi masuk
    ]);

    return redirect()->route('produkmasuk.index')->with('success', 'Data produk masuk berhasil ditambahkan.');
}

    // Menghapus data produk masuk
    public function destroy($id)
    {
        $produkMasuk = ProdukMasukKeluar::findOrFail($id);
        $produkMasuk->delete();

        return redirect()->route('produkmasuk.index')->with('success', 'Data produk masuk berhasil dihapus.');
    }
}
