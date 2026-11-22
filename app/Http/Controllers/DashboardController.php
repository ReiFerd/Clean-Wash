<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $infoLaundry = [
            'nama' => 'Clean-Wash',
            'tagline' => 'Sistem Informasi Manajemen Laundry',
            'deskripsi' => 'Layanan pencucian pakaian profesional dengan pencatatan transaksi transparan, pemantauan status pengerjaan secara real-time, serta pelayanan cepat dan higienis.',
            'jam_operasional' => 'Senin - Minggu, 07.00 - 21.00 WIB',
            'estimasi_reguler' => '2 - 3 Hari Kerja',
            'estimasi_express' => '6 - 24 Jam Selesai',
            'alamat' => 'Jl. Kebersihan No. 12, Kota Anda',
            'telepon' => '0812-3456-7890',
        ];

        $keunggulan = [
            [
                'judul' => 'Pantau Status Real-Time',
                'deskripsi' => 'Pelanggan dapat mengecek progres cucian mulai dari diterima, dicuci, disetrika, hingga siap diambil.',
                'ikon' => 'clock',
            ],
            [
                'judul' => 'Higienis & Terawat',
                'deskripsi' => 'Menggunakan deterjen berkualitas serta pemisahan pakaian sesuai jenis bahan dan warna.',
                'ikon' => 'shield',
            ],
            [
                'judul' => 'Transaksi Transparan',
                'deskripsi' => 'Setiap pesanan tercatat rapi dengan rincian berat, jenis layanan, serta estimasi waktu selesai.',
                'ikon' => 'receipt',
            ],
            [
                'judul' => 'Pilihan Layanan Fleksibel',
                'deskripsi' => 'Tersedia layanan reguler, kilat (express), cuci kering, setrika saja, hingga perawatan khusus.',
                'ikon' => 'sparkle',
            ],
        ];

        $layananUmum = [
            [
                'nama' => 'Cuci Komplit Reguler',
                'keterangan' => 'Cuci, kering, setrika rapi, dan wangi tahan lama.',
                'estimasi' => '2 - 3 Hari',
                'badge' => 'Populer',
            ],
            [
                'nama' => 'Cuci Komplit Express',
                'keterangan' => 'Prioritas pengerjaan cepat untuk kebutuhan mendesak.',
                'estimasi' => '1 Hari / Kilat',
                'badge' => 'Cepat',
            ],
            [
                'nama' => 'Cuci Kering Lipat',
                'keterangan' => 'Dicuci bersih, dikeringkan mesin, dan dilipat rapi tanpa setrika.',
                'estimasi' => '1 - 2 Hari',
                'badge' => 'Hemat',
            ],
            [
                'nama' => 'Setrika & Pewangi',
                'keterangan' => 'Khusus penyetrikaan uap agar pakaian licin, rapi, dan harum.',
                'estimasi' => '1 Hari',
                'badge' => 'Rapi',
            ],
        ];

        $alurLaundry = [
            [
                'langkah' => '01',
                'judul' => 'Serah & Timbang',
                'deskripsi' => 'Pakaian diterima, ditimbang, dan dicatat jenis layanannya ke dalam sistem.',
            ],
            [
                'langkah' => '02',
                'judul' => 'Proses Cuci',
                'deskripsi' => 'Pencucian menggunakan air bersih dan deterjen pilihan sesuai jenis kain.',
            ],
            [
                'langkah' => '03',
                'judul' => 'Kering & Setrika',
                'deskripsi' => 'Pengeringan optimal dilanjutkan penyetrikaan rapi serta pemberian pewangi.',
            ],
            [
                'langkah' => '04',
                'judul' => 'Siap Diambil',
                'deskripsi' => 'Status diperbarui di sistem dan pakaian siap diambil oleh pelanggan.',
            ],
        ];

        return view('DashboardView', compact('infoLaundry', 'keunggulan', 'layananUmum', 'alurLaundry'));
    }
}
