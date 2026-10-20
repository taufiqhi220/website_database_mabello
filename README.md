# 📦 Sistem Manajemen Data Mabello

Aplikasi web manajemen data produk dan distribusi untuk **Mabello**, dibangun menggunakan Laravel 11. Sistem ini mencakup manajemen pengguna multi-role, pencatatan produk masuk/keluar, dan pengelolaan distributor.

## ✨ Fitur Utama

- **Multi-Role Authentication** — Super Administrator, Administrator, dan Distributor dengan hak akses berbeda
- **Manajemen Produk** — CRUD data produk dengan pencatatan batch dan expired
- **Produk Masuk & Keluar** — Tracking keluar masuk produk dengan riwayat lengkap
- **Manajemen Distributor** — Kelola data distributor dan distribusi produk
- **Manajemen Admin** — Super Admin dapat mengelola akun administrator
- **Keamanan** — Password di-hash menggunakan bcrypt, session-based authentication

## 🛠 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** MySQL 8.0
- **PHP:** 8.2+

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Langkah-langkah

1. **Clone repository**
   ```bash
   git clone https://github.com/username/website_database_mabello.git
   cd website_database_mabello
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   
   Buat database MySQL, lalu sesuaikan konfigurasi di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database_manajement_data_mabello
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```
   
   Setelah seeder berhasil, akun default Super Administrator akan dibuat:
   | Field | Nilai |
   |-------|-------|
   | ID User | `superadmin` |
   | Password | `password` |
   
   > ⚠️ **Segera ganti password default setelah login pertama** melalui menu Edit Profil.

6. **Build assets & jalankan server**
   ```bash
   npm run build
   php artisan serve
   ```

7. Buka browser dan akses `http://127.0.0.1:8000`

## 👥 Role & Hak Akses

| Role | Hak Akses |
|------|-----------|
| **Super Administrator** | Kelola semua admin, distributor, produk, dan data masuk/keluar |
| **Administrator** | Kelola produk, data masuk/keluar, dan distributor |
| **Distributor** | Lihat produk keluar yang terkait dengan akunnya |

## 📁 Struktur Penting

```
app/
├── Http/Controllers/
│   ├── LoginController.php        # Autentikasi
│   ├── SuperAdminController.php   # Super Admin dashboard & profil
│   ├── AdminController.php        # CRUD Admin
│   ├── DistributorController.php  # CRUD Distributor
│   ├── ProdukController.php       # CRUD Produk
│   ├── ProdukMasukController.php  # Pencatatan produk masuk
│   └── ProdukKeluarController.php # Pencatatan produk keluar
├── Models/
│   ├── User.php                   # Model utama (semua role)
│   ├── Distributor.php
│   ├── ProdukMasukKeluar.php
│   └── ...
database/
├── migrations/                    # Skema database
└── seeders/
    └── DatabaseSeeder.php         # Seed akun Super Admin default
```

## 🔐 Keamanan

- Password di-hash otomatis menggunakan **bcrypt** via Laravel model casting
- Session-based authentication
- CSRF protection pada semua form
- Password tidak pernah ditampilkan dalam bentuk asli

## 📄 Lisensi

Project ini dibuat untuk keperluan portfolio dan pembelajaran.
