# 🛒 eKasir - Laravel 13 Point of Sale System

![Laravel 13](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4%2B-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

**eKasir** adalah sistem Kasir / Point of Sale (POS) berbasis web modern yang dibangun menggunakan framework **Laravel 13**. Sistem ini dirancang untuk mengotomatisasi transaksi toko retail/F&B, mengelola stok barang secara _realtime_, serta menyajikan laporan penjualan dengan antarmuka yang cepat dan _responsive_.

---

## 🚀 Fitur Utama (v1.0)

### 👥 1. Role-Based Access Control (RBAC)

Sistem memiliki isolasi hak akses terpisah untuk 2 role utama:

- **Admin**: Akses penuh ke _Dashboard Analytics_, CRUD Master Produk & Kategori, Manajemen User Kasir, Mutasi Stok, dan Laporan Penjualan lengkap.
- **Kasir**: Akses terbatas yang terfokus pada antarmuka transaksi kasir (_POS Checkout_), cetak struk, dan pencarian produk.

### 📦 2. Master Produk & Inventaris

- Manajemen produk dengan barcode/SKU unik.
- Kategori produk bertingkat.
- Pengurangan stok otomatis saat transaksi berhasil.
- _Low stock alert_ (peringatan stok menipis).
- _Database Lock (`lockForUpdate`)_ untuk mencegah _race condition_ saat stok produk habis bersamaan.

### 💳 3. Antarmuka Kasir (POS Interface) & Pembayaran

- Pemindaian barcode cepat (barcode scanner compatible).
- Kalkulasi keranjang belanja dinamis (Subtotal, Diskon, Kembalian).
- Mendukung metode pembayaran **Tunai (Cash)**, **QRIS / E-Wallet**, dan **Kartu Debit/Kredit**.
- Integrasi cetak struk thermal via command ESC/POS (USB / Bluetooth printer).

### 📊 4. Laporan & Analytics

- Dashboard grafik ringkasan omzet dan transaksi harian/bulanan.
- Laporan Laba Kotor dan Produk Terlaris (_Top Selling Products_).
- Ekspor laporan transaksi ke format PDF dan Excel.

---

## 🛠️ Stack Teknologi

- **Backend**: PHP 8.4+ & Laravel 13.x
- **Frontend**: Vue.js + Tailwind CSS
- **Database**: MySQL / mariadb
- **ORM**: Laravel Eloquent
- **Printer Engine**: `mike42/escpos-php`

---

## 🗄️ Skema Database & Relasi (ERD)

```
[ users ] 1  ────  N [ transactions ] 1  ────  N [ transaction_details ]
                                                        │ N
                                                        │
[ categories ] 1  ────────────────  N [ products ] ─────┘ 1
```

### Tabel Utama:

- `users`: Menyimpan kredensial Admin & Kasir.
- `categories`: Kategori barang/produk.
- `products`: Master produk, barcode, harga beli (HPP), harga jual, dan jumlah stok.
- `transactions`: Header transaksi penjualan (Nomor Invoice, total, pembayaran, metode bayar).
- `transaction_details`: Detail rincian barang yang dibeli pada setiap transaksi.

---

## 📦 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek di lingkungan lokal Anda:

### 1. Prasyarat Sistem

- PHP >= 8.4 dengan ekstensi: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`
- Composer 2.x
- Node.js & NPM
- MySQL / Mariadb

### 2. Clone Repositori

```bash
git clone https://github.com/abduljohar11/eKasir.git
cd eKasir
```

### 3. Instal Dependensi PHP & Node.js

```bash
composer install
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:

```bash
cp .env.example .env
```

Atur kredensial database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eKasir_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key & Migrasi Database

```bash
php artisan key:generate
php artisan migrate --seed
```

> **Catatan:** Fitur seeder akan secara otomatis membuat akun default untuk pengujian:
>
> - **Admin**: `admin@pos.com` / `password`
> - **Kasir**: `kasir@pos.com` / `password`

### 6. Build Asset Frontend & Jalankan Server Lokal

```bash
npm run dev
# Di terminal terpisah
php artisan serve
```

Buka browser dan akses aplikasi di: `http://127.0.0.1:8000`

---

## 🔒 Keamanan & Praktik Terbaik

1. **Atomic Transactions**: Seluruh transaksi kasir dan mutasi stok dibungkus menggunakan `DB::beginTransaction()` untuk menjamin konsistensi data (_ACID Compliance_).
2. **Race Condition Prevention**: Menggunakan `lockForUpdate()` pada penarikan stok produk saat checkout kasir.
3. **Audit Trail**: Pencatatan riwayat setiap transaksi beserta identitas akun kasir yang bertugas (`user_id`).

---

## note

Aplikasi masih dalam tahap pengembangan awal

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
