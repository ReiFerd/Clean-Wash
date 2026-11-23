<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_layanan' => 'Cuci Kering',  'harga_per_kg' => 5000],
            ['nama_layanan' => 'Cuci Setrika', 'harga_per_kg' => 7000],
            ['nama_layanan' => 'Setrika Saja', 'harga_per_kg' => 4000],
        ];

        foreach ($data as $d) {
            Layanan::firstOrCreate(['nama_layanan' => $d['nama_layanan']], $d);
        }

        $admins = [
            [
                'nama_admin'     => 'Admin Utama',
                'username_admin' => 'admin',
                'password_admin' => 'admin123',
                'no_telepon'     => '081234567890',
            ],
            [
                'nama_admin'     => 'Staff Clean-Wash',
                'username_admin' => 'staff',
                'password_admin' => 'staff123',
                'no_telepon'     => '089876543210',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['username_admin' => $admin['username_admin']],
                $admin
            );
        }
    }
}
