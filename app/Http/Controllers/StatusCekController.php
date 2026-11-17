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
                'tanggal_transaksi' => '2026-05-05 08:00:00',
                'status_laundry' => 'Disetrika',
                'metode_pengambilan' => 'Ambil Sendiri',
                'updated_at' => now()
            ];
        }

        $daftarStatus = ['Menunggu', 'Diproses', 'Dicuci', 'Disetrika', 'Selesai', 'Diambil'];
        $statusSekarang = $transaksi->status_laundry ?? 'Menunggu';
        
        $currentIndex = array_search($statusSekarang, $daftarStatus);
        if ($currentIndex === false) {
            $currentIndex = 0;
        }

        $timeline = [];
        foreach ($daftarStatus as $index => $status) {
            $selesai = $index <= $currentIndex;
            $aktif = $index === $currentIndex;

            $timeline[] = [
                'status' => $status,
                'waktu' => $selesai ? date('d M Y - H:i', strtotime($transaksi->updated_at ?? now())) : '-',
                'selesai' => $selesai,
                'aktif' => $aktif
            ];
        }

        return view('StatusCekView', compact('transaksi', 'timeline'));
    }
}
