<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel db_user sesuai dengan model
        Schema::create('db_user', function (Blueprint $table) {
            $table->string('id_user')->primary(); // Primary key menggunakan 'id_user'
            $table->string('nama'); // Nama pengguna
            $table->string('password'); // Password pengguna
            $table->string('posisi')->nullable(); // Posisi pengguna, bisa kosong (nullable)
            $table->boolean('status')->default(true); // Status aktif atau tidak, default true
            $table->timestamps(); // Kolom created_at dan updated_at
        });
        
        // Membuat tabel password_reset_tokens untuk reset password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Membuat tabel sessions untuk manajemen sesi pengguna
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id')->nullable()->index(); // Disesuaikan dengan tipe id_user
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel jika rollback
        Schema::dropIfExists('db_user');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
