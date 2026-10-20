# 📦 Sistem Manajemen Distribusi Mabello — CV. Idlan

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

Aplikasi web sistem manajemen basis data dan operasional distribusi yang dikembangkan untuk **CV. Idlan**, distributor resmi produk perawatan dan kosmetik **Mabello**. Sistem ini mengintegrasikan pencatatan stok gudang, alur produk masuk/keluar, pelacakan nomor batch & masa kedaluwarsa, serta koordinasi jaringan mitra distributor berbasis hak akses multi-level.

---

## ✨ Fitur Utama

### 1. Multi-Level Role-Based Access Control (RBAC)
- **Super Administrator (Manajemen Pusat CV. Idlan):** Kontrol penuh atas seluruh master data, hak akses administrator, otorisasi akun distributor, serta audit riwayat aktivitas sistem.
- **Administrator (Operasional & Gudang):** Manajemen katalog produk Mabello, pencatatan produk masuk dari pabrik/produsen, serta pemrosesan pengiriman produk keluar ke jaringan distributor.
- **Distributor (Mitra / Distribution Center):** Portal khusus mitra untuk melihat riwayat dan status alokasi produk keluar yang ditujukan langsung ke unit distribusinya secara real-time.

### 2. Manajemen Produk & Stok Gudang
- CRUD data master produk Mabello lengkap dengan informasi varian, satuan, dan spesifikasi produk.
- Perhitungan stok aktual yang terhubung secara dinamis dengan riwayat transaksi masuk dan keluar.

### 3. Pelacakan Logistik Masuk & Keluar (Inbound & Outbound)
- **Produk Masuk:** Pencatatan penerimaan barang pasokan baru lengkap dengan nomor batch, kuantitas, dan tanggal kedaluwarsa.
- **Produk Keluar:** Alokasi distribusi barang ke masing-masing distribution center atau mitra ritel CV. Idlan.

### 4. Standar Keamanan Sistem
- Seluruh password di-hash secara aman menggunakan algoritma **bcrypt** via Laravel Eloquent model casting (`'password' => 'hashed'`).
- Autentikasi berbasis session dengan proteksi CSRF (*Cross-Site Request Forgery*) pada setiap form transaksi.
- Sensor masking data kredensial pada antarmuka admin untuk menjaga kerahasiaan pengguna.

---

## 🛠 Tech Stack

| Layer | Teknologi |
|---|---|
| **Backend Framework** | Laravel 11 |
| **Bahasa Pemrograman** | PHP 8.2+ (Kompatibel hingga PHP 8.5) |
| **Database** | MySQL 8.0 (Relational Database) |
| **Frontend UI** | Blade Templates, AdminLTE / Bootstrap 4, Tailwind CSS |
| **Build Tools** | Vite, NPM, Composer |
| **Version Control** | Git & GitHub |

---

## 📁 Struktur Direktori Utama

```
app/
├── Http/Controllers/
│   ├── LoginController.php             # Autentikasi & manajemen sesi aman
│   ├── SuperAdminController.php        # Dashboard manajemen pusat CV. Idlan
│   ├── AdminController.php             # Manajemen admin operasional
│   ├── DistributorController.php       # Portal & data mitra distributor
│   ├── ProdukController.php            # Master data produk Mabello
│   ├── ProdukMasukController.php       # Logistik pasokan produk masuk
│   └── ProdukKeluarController.php      # Distribusi produk keluar ke mitra
├── Models/
│   ├── User.php                        # Autentikasi user & multi-role casting
│   ├── Produk.php                      # Entitas katalog produk Mabello
│   ├── Distributor.php                 # Entitas data mitra distributor
│   └── ProdukMasukKeluar.php           # Relasi transaksi logistik & distribution center
database/
├── migrations/                         # Skema database relasional
└── seeders/
    └── DatabaseSeeder.php              # Inisialisasi awal Super Administrator
```

---

## 🚀 Panduan Instalasi & Penggunaan Lokal

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL Server (Laragon, XAMPP, atau MySQL native)
- Node.js & NPM

### Langkah-langkah

1. **Clone repository:**
   ```bash
   git clone https://github.com/taufiqhi220/website_database_mabello.git
   cd website_database_mabello
   ```

2. **Install dependency PHP dan Javascript:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database:**
   Buat database baru di MySQL (contoh: `database_manajement_data_mabello`), lalu sesuaikan konfigurasi pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database_manajement_data_mabello
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi & Seeder:**
   ```bash
   php artisan migrate --seed
   ```

6. **Kredensial Akun Default (Demo / Testing):**
   Setelah proses migrasi dan seeding selesai, akun default Super Administrator siap digunakan:
   
   | Kredensial | Nilai Default |
   |---|---|
   | **URL Login** | `http://127.0.0.1:8000/login` |
   | **ID User / Username** | `superadmin` |
   | **Password** | `password` |
   | **Role** | Super Administrator (CV. Idlan) |

   > 🔒 *Catatan: Pada lingkungan produksi, ganti password default setelah login pertama melalui menu Edit Profil.*

7. **Compile Asset & Jalankan Web Server:**
   ```bash
   npm run build
   php artisan serve
   ```
   Akses aplikasi di browser melalui URL: **`http://127.0.0.1:8000`**

---

## 💡 Arsitektur & Kualitas Kode

- **Database Integrity & Relational Constraints:** Membangun relasi foreign key antara entitas produk, transaksi logistik masuk/keluar, dan akun distributor (`distribution_center`) guna memastikan integritas data logistik tanpa anomali.
- **Modern Security Architecture:** Mengimplementasikan standar Laravel 11 terkini dengan automatic model hashing, sanitasi request, dan validasi berbasis regex.
- **PHP 8.5 Compatibility:** Penanganan kompatibilitas terhadap perubahan driver PDO MySQL modern pada versi PHP terbaru.

---

## 📄 Lisensi & Hak Cipta

Proyek ini dikembangkan untuk kebutuhan sistem manajemen operasional **CV. Idlan** (Distributor Resmi Produk Mabello).
