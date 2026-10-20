<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Nama tabel di database

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'sisa_pcs',
        'sisa_dos',
        'pcs_per_dos',
    ];

    // Relasi ke ProdukMasukKeluar (produk masuk dan keluar)
    public function produkMasukKeluar()
    {
        return $this->hasMany(ProdukMasukKeluar::class, 'produk_id');
    }

    // Scope untuk mengambil produk masuk (tanggal_masuk terisi)
    public function scopeMasuk($query)
    {
        return $query->whereHas('produkMasukKeluar', function($q) {
            $q->whereNotNull('tanggal_masuk');
        });
    }

    // Scope untuk mengambil produk keluar (tanggal_keluar terisi)
    public function scopeKeluar($query)
    {
        return $query->whereHas('produkMasukKeluar', function($q) {
            $q->whereNotNull('tanggal_keluar');
        });
    }
}
