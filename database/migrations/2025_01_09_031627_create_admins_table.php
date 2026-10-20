<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('id_user')->unique(); // ID unik untuk admin
            $table->string('name'); // Nama admin
            $table->string('password'); // Password (hash atau plaintext)
            $table->string('posisi')->default('admin'); // Posisi (misalnya: admin, super administrator)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
