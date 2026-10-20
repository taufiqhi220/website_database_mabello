<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMasukKeluar extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'produk_masuk_keluar';
    
    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'nama_produk',          // Nama produk
        'tanggal_masuk',        // Tanggal produk masuk
        'tanggal_keluar',       // Tanggal produk keluar
        'nomor_batch_exp',      // Nomor batch atau tanggal kedaluwarsa
        'distribution_center',  // Foreign key ke tabel users
        'jumlah',               // Jumlah produk
        'tipe_transaksi',       // Tipe transaksi (misalnya masuk/keluar)
    ];
    
    /**
     * Scope untuk mengambil produk yang memiliki tanggal_masuk terisi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMasuk($query)
    {
        return $query->whereNotNull('tanggal_masuk');
    }

    /**
     * Scope untuk mengambil produk yang memiliki tanggal_keluar terisi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKeluar($query)
    {
        return $query->whereNotNull('tanggal_keluar');
    }

    /**
     * Relasi ke tabel users.
     * ProdukMasukKeluar memiliki foreign key `distribution_center` yang mengarah ke `id_user` pada tabel users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor()
    {
        return $this->belongsTo(User::class, 'distribution_center', 'id_user')
            ->where('posisi', 'distributor'); // Hanya ambil user dengan posisi distributor
    }   
}
