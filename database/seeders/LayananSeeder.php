<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
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
    }
}