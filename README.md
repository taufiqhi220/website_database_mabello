# 📦 Sistem Manajemen Rantai Pasok & Distribusi Mabello — CV. Idlan

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

Aplikasi web sistem manajemen basis data dan operasional distribusi yang dikembangkan untuk **CV. Idlan**, distributor resmi produk perawatan dan kosmetik **Mabello**. Sistem ini mengintegrasikan pencatatan stok gudang, alur produk masuk/keluar, pelacakan nomor batch & kedaluwarsa produk, serta koordinasi jaringan mitra distributor berbasis hak akses multi-level.

---

## 💼 Latar Belakang & Pengalaman Kerja (CV. Idlan)

Proyek ini dibangun sebagai solusi digitalisasi proses bisnis operasional pada **CV. Idlan** dalam mengelola distribusi produk **Mabello**. 

Sebelumnya, pencatatan keluar masuk barang dan pemantauan distribusi ke berbagai cabang / distributor sering menghadapi tantangan sinkronisasi data manual. Sistem ini dirancang untuk:
1. **Sentralisasi Data Inventaris:** Menghilangkan disparitas data stok antara gudang pusat CV. Idlan dengan alokasi pengiriman produk Mabello.
2. **Quality Control & Kepatuhan Kosmetik:** Memastikan setiap pengiriman tercatat nomor batch dan masa berlaku (*expiry date*)-nya, menjaga standar mutu produk kecantikan resmi.
3. **Visibilitas Real-Time untuk Mitra:** Memberikan portal mandiri bagi para distributor/distribution center agar dapat memantau penerimaan barang secara transparan.

---

## ✨ Fitur Utama Sistem

### 1. Multi-Level Role-Based Access Control (RBAC)
- **Super Administrator (Manajemen Pusat CV. Idlan):** Memiliki kontrol mutlak atas konfigurasi sistem, audit data, manajemen akun Administrator, dan monitoring seluruh aktivitas distribusi.
- **Administrator (Operasional & Gudang):** Mengelola katalog produk Mabello, mencatat produk masuk dari pabrik/produsen, serta memproses pengiriman produk keluar ke jaringan distributor.
- **Distributor (Mitra / Distribution Center):** Portal khusus mitra untuk melihat riwayat dan status alokasi produk keluar yang ditujukan langsung ke titik distribusinya.

### 2. Manajemen Produk & Stok Gudang
- CRUD data master produk Mabello lengkap dengan informasi varian, satuan, dan spesifikasi produk.
- Perhitungan stok aktual yang terhubung dinamis dengan riwayat transaksi masuk dan keluar.

### 3. Pelacakan Logistik Masuk & Keluar (Inbound & Outbound Tracking)
- **Produk Masuk:** Pencatatan penerimaan barang pasokan baru lengkap dengan nomor batch, kuantitas, dan tanggal kedaluwarsa.
- **Produk Keluar:** Alokasi distribusi barang ke masing-masing distribution center atau mitra ritel CV. Idlan.

### 4. Standar Keamanan & Reliabilitas
- Seluruh password di-hash secara aman menggunakan algoritma **bcrypt** via Laravel Eloquent model casting (`'password' => 'hashed'`).
- Autentikasi berbasis session dengan proteksi CSRF (*Cross-Site Request Forgery*) pada setiap form transaksi.
- Sensor masking data kredensial pada antarmuka admin untuk menjaga privasi pengguna.

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

## 📁 Struktur Arsitektur Direktori

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

## 🚀 Panduan Instalasi & Menjalankan Lokal

Bagi reviewer atau penguji yang ingin menjalankan proyek ini di lingkungan lokal:

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
   Buat database baru di MySQL (contoh: `database_manajement_data_mabello`), lalu sesuaikan file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database_manajement_data_mabello
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi & Seeder Demo:**
   ```bash
   php artisan migrate --seed
   ```

6. **Kredensial Default untuk Pengujian Portofolio:**
   Setelah proses migrasi dan seeding selesai, akun default Super Administrator siap digunakan:
   
   | Kredensial | Nilai Default |
   |---|---|
   | **URL Login** | `http://127.0.0.1:8000/login` |
   | **ID User / Username** | `superadmin` |
   | **Password** | `password` |
   | **Role** | Super Administrator (CV. Idlan) |

   > 🔒 *Catatan: Pada lingkungan produksi, ganti password default segera setelah login pertama melalui menu Edit Profil.*

7. **Compile Asset & Jalankan Web Server:**
   ```bash
   npm run build
   php artisan serve
   ```
   Akses aplikasi di browser melalui URL: **`http://127.0.0.1:8000`**

---

## 💡 Sorotan Kontribusi Engineering (Portofolio)

- **Database Integrity & Relational Constraints:** Membangun relasi foreign key antara entitas produk, transaksi logistik masuk/keluar, dan akun distributor (`distribution_center`) guna memastikan data konsisten tanpa anomali.
- **Modern Security Architecture:** Mengimplementasikan standar Laravel 11 terkini dengan automatic model hashing, sanitasi request, dan validasi berbasis regex.
- **PHP 8.5 Compatibility:** Melakukan penanganan kompatibilitas terhadap perubahan driver PDO MySQL modern pada versi PHP terbaru.

---

## 📄 Lisensi & Hak Cipta

Proyek ini dikembangkan oleh pengembang untuk kebutuhan sistem operasional **CV. Idlan** (Distributor Mabello) dan ditampilkan sebagai materi portofolio pengalaman kerja rekayasa perangkat lunak.
