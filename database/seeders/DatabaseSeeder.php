<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::create([
            'nama_admin' => 'Admin Laundry',
            'username_admin' => 'admin1',
            'password_admin' => Hash::make('password'),
            'no_telepon' => '081234567890',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_telepon' => '081298765432',
            'username_pelanggan' => 'budi',
            'password_pelanggan' => Hash::make('password'),
        ]);

        Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_admin' => $admin->id_admin,
            'tanggal_transaksi' => now()->toDateString(),
            'status_laundry' => 'Diproses', // sesuai $statusList di StatusController
            'metode_pengambilan' => 'Ambil Sendiri', // maks 20 karakter
        ]);

        Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_admin' => $admin->id_admin,
            'tanggal_transaksi' => now()->toDateString(),
            'status_laundry' => 'Dicuci',
            'metode_pengambilan' => 'Diantar',
        ]);
    }
}
