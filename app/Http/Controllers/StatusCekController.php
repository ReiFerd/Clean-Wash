<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class StatusCekController extends Controller
{
    public function index($id = 1)
    {
        $transaksi = Transaksi::with(['pelanggan', 'admin', 'detailTransaksi', 'pembayaran'])->find($id);

        if (!$transaksi) {
            $transaksi = (object)[
                'id_transaksi' => 1,
                'tanggal_transaksi' => '2026-05-05',
                'status_laundry' => 'Disetrika',
                'metode_pengambilan' => 'Ambil Sendiri'
            ];
        }

        $timeline = [
            ['status' => 'Menunggu', 'waktu' => '05 Mei 2026 - 08:00', 'selesai' => true],
            ['status' => 'Diproses', 'waktu' => '05 Mei 2026 - 09:30', 'selesai' => true],
            ['status' => 'Dicuci', 'waktu' => '05 Mei 2026 - 11:00', 'selesai' => true],
            ['status' => 'Disetrika', 'waktu' => '05 Mei 2026 - 13:15', 'selesai' => true, 'aktif' => true],
            ['status' => 'Selesai', 'waktu' => '-', 'selesai' => false],
            ['status' => 'Diambil', 'waktu' => '-', 'selesai' => false],
        ];

        return view('StatusCekView', compact('transaksi', 'timeline'));
    }
}
