# Clean-Wash — Sistem Informasi Manajemen Laundry

Website berbasis **Laravel 13** yang dibuat untuk memenuhi tugas kuliah. Aplikasi ini digunakan untuk mengelola operasional jasa laundry secara digital, mulai dari pencatatan pesanan pelanggan, pembaruan status proses cucian, hingga laporan transaksi dan pendapatan, dengan hak akses terpisah untuk **Admin** dan **Pelanggan**.

## Fitur Utama

- **Autentikasi Multi-Role** — Login dan registrasi dengan pembagian akses antara Admin dan Pelanggan.
- **Manajemen Pelanggan** — Mengelola data pelanggan (tambah, lihat, ubah, dan hapus).
- **Pemesanan Laundry** — Mencatat transaksi pemesanan layanan laundry (Cuci Kering, Cuci Setrika, Setrika) beserta detail pembayaran.
- **Update & Cek Status Cucian** — Memperbarui progres pengerjaan laundry dan memantau status pesanan secara real-time.
- **Laporan Transaksi** — Menampilkan ringkasan data transaksi dan pendapatan laundry.

## Cara Menjalankan Proyek

1. Sesuaikan nama database pada file `.env` (`DB_DATABASE`), lalu buat tabel sekaligus isi data awal:
   ```bash
   php artisan migrate:fresh --seed
   ```

2. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## Akun Pengujian (Seeder)

- **Admin:** `admin` | Password: `admin123`
- **Pelanggan:** Dapat mendaftar langsung melalui halaman **Register**.
