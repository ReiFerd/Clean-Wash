# Sistem Pemesanan Layanan & Manajemen Transaksi

Aplikasi web berbasis **Laravel 13** untuk mengelola operasional pemesanan layanan dan transaksi pelanggan. Website ini mencakup pengelolaan data pelanggan, pencatatan pemesanan layanan, pembaruan status pengerjaan, fitur cek status pesanan, serta laporan transaksi.

## Fitur Utama

- **Manajemen Pelanggan** (`PelangganController`) — Mengelola data pelanggan (tambah, lihat, ubah, dan hapus).
- **Manajemen Pemesanan** (`PemesananController`) — Mencatat dan memperbarui data pemesanan layanan beserta detail transaksi dan pembayaran.
- **Manajemen & Cek Status** (`StatusController`, `StatusCekController`) — Memperbarui status pesanan dan menyediakan pengecekan status pesanan.
- **Laporan Transaksi** (`LaporanController`) — Menampilkan ringkasan dan laporan data transaksi.

## Persyaratan Sistem

- PHP (sesuai kebutuhan Laravel 13)
- Composer
- Database (MySQL / PostgreSQL / SQLite)

## Instalasi & Setup Database

1. Clone repository ini dan masuk ke direktori proyek.
2. Install dependency PHP dengan Composer:

~~~bash
composer install
~~~

3. Salin file konfigurasi environment dan generate application key:

~~~bash
cp .env.example .env
php artisan key:generate
~~~

4. Sesuaikan konfigurasi koneksi database pada file `.env` (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
5. Jalankan perintah berikut untuk membuat struktur tabel database sekaligus mengisi data awal (seeding):

~~~bash
php artisan migrate:fresh --seed
~~~

> **Catatan:** Perintah `php artisan migrate:fresh --seed` akan menghapus seluruh tabel yang ada di database, menjalankan ulang seluruh migration dari awal, dan mengeksekusi `DatabaseSeeder` untuk mengisi data awal.

6. Jalankan server pengembangan lokal:

~~~bash
php artisan serve
~~~

## Struktur Proyek (MVC & Laravel 13)

Proyek ini dibangun menggunakan **Laravel 13** dengan menerapkan pola arsitektur **MVC (Model-View-Controller)** untuk memisahkan logika data, tampilan, dan alur aplikasi:

- **Model (`app/Models/`)**
  Merepresentasikan struktur data, relasi antar tabel, dan interaksi dengan database menggunakan Eloquent ORM.
  Contoh model pada proyek ini: `Layanan.php`, `Transaksi.php`.

- **View (`resources/views/`)**
  Berisi antarmuka pengguna (UI) yang dirender menggunakan Blade template engine untuk menampilkan halaman web kepada pengguna.

- **Controller (`app/Http/Controllers/`)**
  Bertanggung jawab menerima request dari pengguna, memproses logika bisnis, berinteraksi dengan Model, lalu mengembalikan response atau View.
  Controller yang tersedia pada proyek ini:
  - `LaporanController.php`
  - `PelangganController.php`
  - `PemesananController.php`
  - `StatusCekController.php`
  - `StatusController.php`

- **Routing (`routes/`)**
  Mendefinisikan endpoint URL aplikasi (seperti `web.php`) dan menghubungkannya ke Controller terkait.

- **Database (`database/`)**
  Berisi `migrations/` untuk skema tabel, `seeders/` (`DatabaseSeeder.php`) untuk data awal, dan `factories/` (`UserFactory.php`) untuk data dummy pengujian.
