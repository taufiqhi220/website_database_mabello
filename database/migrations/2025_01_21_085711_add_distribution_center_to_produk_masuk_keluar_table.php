<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('produk_masuk_keluar', function (Blueprint $table) {
            // Kolom distribution_center sudah ada, hanya tambahkan foreign key constraint
            if (!Schema::hasColumn('produk_masuk_keluar', 'distribution_center')) {
                $table->string('distribution_center')->nullable()->after('nomor_batch_exp');
            }
        });
    }

    public function down()
    {
        Schema::table('produk_masuk_keluar', function (Blueprint $table) {
            $table->dropForeign(['distribution_center']);
            $table->dropColumn('distribution_center');
        });
    }

};
