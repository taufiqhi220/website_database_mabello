<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $produk = Produk::all();  // Use the correct variable name
        return view('pages.produk.index', compact('produk')); // Use 'produk' instead of 'produks'
    }

    /**
     * Menampilkan form untuk menambahkan produk baru.
     */
    public function create()
    {
        return view('pages.produk.create'); // Perbaiki rujukan view
    }

    /**
     * Menyimpan data produk baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|string|unique:produk,kode_produk|max:50',
            'nama_produk' => 'required|string|max:255',
            'sisa_pcs' => 'required|integer|min:0',
            'sisa_dos' => 'required|integer|min:0',
            'pcs_per_dos' => 'required|integer|min:1',
        ]);

        // Menyimpan produk baru
        Produk::create($request->only(['kode_produk', 'nama_produk', 'sisa_pcs', 'sisa_dos', 'pcs_per_dos']));

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk produk tertentu.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pages.produk.edit', compact('produk')); // Perbaiki rujukan view
    }

    /**
     * Memperbarui data produk tertentu.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => "required|string|max:50|unique:produk,kode_produk,$id",
            'nama_produk' => 'required|string|max:255',
            'sisa_pcs' => 'required|integer|min:0',
            'sisa_dos' => 'required|integer|min:0',
            'pcs_per_dos' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->only(['kode_produk', 'nama_produk', 'sisa_pcs', 'sisa_dos', 'pcs_per_dos']));

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Menghapus data produk tertentu.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
