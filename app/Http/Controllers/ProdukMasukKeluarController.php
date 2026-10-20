<?php

namespace App\Http\Controllers;

use App\Models\ProdukMasukKeluar;
use Illuminate\Http\Request;

class ProdukMasukKeluarController extends Controller
{
    // Menampilkan halaman produk masuk dan keluar
    public function index()
{
    // Menampilkan data produk masuk dan keluar
    $produkMasukKeluar = ProdukMasukKeluar::all(); // Bisa ditambahkan filter jika perlu berdasarkan tipe transaksi
    return view('produk_masuk_keluar.index', compact('produkMasukKeluar'));
}

    // Menampilkan form untuk menambahkan produk masuk atau keluar
    public function create()
    {
        return view('produk_masuk_keluar.create');
    }

    // Menyimpan data produk masuk atau keluar
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_keluar' => 'nullable|date',
            'nomor_batch_exp' => 'required|string',
            'distribution_center' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        ProdukMasukKeluar::create([
            'nama_produk' => $request->nama_produk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'nomor_batch_exp' => $request->nomor_batch_exp,
            'distribution_center' => $request->distribution_center,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('produkmasukkeluar.index')->with('success', 'Data produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk masuk atau keluar
    public function edit($id)
    {
        $produkMasukKeluar = ProdukMasukKeluar::findOrFail($id);
        return view('produk_masuk_keluar.edit', compact('produkMasukKeluar'));
    }

    // Memperbarui data produk masuk atau keluar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_keluar' => 'nullable|date',
            'nomor_batch_exp' => 'required|string',
            'distribution_center' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produkMasukKeluar = ProdukMasukKeluar::findOrFail($id);
        $produkMasukKeluar->update([
            'nama_produk' => $request->nama_produk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'nomor_batch_exp' => $request->nomor_batch_exp,
            'distribution_center' => $request->distribution_center,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('produkmasukkeluar.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    // Menghapus data produk masuk atau keluar
    public function destroy($id)
    {
        $produkMasukKeluar = ProdukMasukKeluar::findOrFail($id);
        $produkMasukKeluar->delete();

        return redirect()->route('produkmasukkeluar.index')->with('success', 'Data produk berhasil dihapus.');
    }
}
