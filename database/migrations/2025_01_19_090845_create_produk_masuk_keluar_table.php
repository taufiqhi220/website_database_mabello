<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukMasukKeluarTable extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up()
    {
        Schema::create('produk_masuk_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk'); // Nama produk
            $table->date('tanggal_masuk')->nullable(); // Tanggal produk masuk
            $table->date('tanggal_keluar')->nullable(); // Tanggal produk keluar
            $table->string('nomor_batch_exp'); // Nomor batch atau Exp
            $table->string('distribution_center')->nullable(); // Membuat nullable
            $table->integer('jumlah'); // Jumlah produk (pcs)
            $table->string('tipe_transaksi'); // Kolom tipe transaksi, 'masuk' atau 'keluar'
            $table->timestamps(); // Tanggal pembuatan dan pembaruan data
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down()
    {
        Schema::dropIfExists('produk_masuk_keluar');
    }
}
