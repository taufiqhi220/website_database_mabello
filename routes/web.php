<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukMasukController; // Controller ProdukMasuk
use App\Http\Controllers\ProdukKeluarController; // Controller ProdukKeluar
use Illuminate\Support\Facades\Auth;

// Redirect ke halaman login jika mengakses root
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login dan Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Middleware auth untuk proteksi rute
Route::middleware('auth')->group(function () {

    // SuperAdmin Routes
    Route::get('/sadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/sadmin/edit', [SuperAdminController::class, 'editProfile'])->name('profile.edit');
    Route::put('/sadmin/edit', [SuperAdminController::class, 'updateProfile'])->name('profile.update');

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard'); // Halaman dashboard
        Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit'); // Mengambil ID admin yang ingin diedit
        Route::put('/edit/{id}', [AdminController::class, 'update'])->name('admins.update'); // Memperbarui data admin berdasarkan ID
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    });

    // Produk Routes
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produk.index'); // Menampilkan daftar produk
        Route::get('/create', [ProdukController::class, 'create'])->name('produk.create'); // Menampilkan form tambah produk
        Route::post('/', [ProdukController::class, 'store'])->name('produk.store'); // Menyimpan produk baru
        Route::get('/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // Menampilkan form edit produk
        Route::put('/{id}', [ProdukController::class, 'update'])->name('produk.update'); // Memperbarui data produk
        Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy'); // Menghapus produk
    });

    // Produk Masuk Routes
    Route::prefix('produk-masuk')->group(function () {
        Route::get('/', [ProdukMasukController::class, 'index'])->name('produkmasuk.index'); // Menampilkan daftar produk masuk
        Route::get('/create', [ProdukMasukController::class, 'create'])->name('produkmasuk.create'); // Menampilkan form produk masuk
        Route::post('/', [ProdukMasukController::class, 'store'])->name('produkmasuk.store'); // Menyimpan produk masuk
        Route::delete('/{id}', [ProdukMasukController::class, 'destroy'])->name('produkmasuk.destroy'); // Menghapus produk masuk
    });

    // Produk Keluar Routes
    Route::prefix('produk-keluar')->group(function () {
        Route::get('/', [ProdukKeluarController::class, 'index'])->name('produkkeluar.index'); // Menampilkan daftar produk keluar
        Route::get('/create', [ProdukKeluarController::class, 'create'])->name('produkkeluar.create'); // Menampilkan form produk keluar
        Route::post('/', [ProdukKeluarController::class, 'store'])->name('produkkeluar.store'); // Menyimpan produk keluar
        Route::delete('/{id}', [ProdukKeluarController::class, 'destroy'])->name('produkkeluar.destroy'); // Menghapus produk keluar
    });

    // Distributor Routes
    Route::prefix('distributor')->group(function () {
        Route::get('/', [DistributorController::class, 'index'])->name('distributors.index'); // Menampilkan daftar distributor
        Route::get('/produk-keluar', [DistributorController::class, 'produkkeluar'])->name('distributors.produkkeluar');
        Route::get('/dashboard', [DistributorController::class, 'dashboard'])->name('distributors.dashboard');
        Route::get('/create', [DistributorController::class, 'create'])->name('distributors.create'); // Menampilkan form tambah distributor
        Route::post('/', [DistributorController::class, 'store'])->name('distributors.store'); // Menyimpan distributor baru
        Route::get('/{id_user}/edit', [DistributorController::class, 'edit'])->name('distributors.edit');
        Route::put('/{id_user}/update', [DistributorController::class, 'update'])->name('distributors.update');
        Route::delete('/{id_user}', [DistributorController::class, 'destroy'])->name('distributors.destroy');
    });
});

