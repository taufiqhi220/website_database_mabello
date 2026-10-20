<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel produk.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id(); // Kolom id untuk primary key
            $table->string('kode_produk')->unique(); // Kolom kode produk
            $table->string('nama_produk'); // Kolom nama produk
            $table->integer('sisa_pcs'); // Kolom sisa pcs
            $table->integer('sisa_dos'); // Kolom sisa dos
            $table->integer('pcs_per_dos'); // Kolom pcs per dos
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Membalikkan migration untuk menghapus tabel produk.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
