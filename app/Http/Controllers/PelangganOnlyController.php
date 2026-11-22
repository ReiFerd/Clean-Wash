<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PelangganOnlyController extends Controller
{
    public function status(Request $request)
    {
        $pelangganId = session('pelanggan_id');

        if (!$pelangganId || session('role') !== 'pelanggan') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelanggan terlebih dahulu.');
        }

        $pelanggan = Pelanggan::find($pelangganId);

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Data pelanggan tidak ditemukan. Silakan login kembali.');
        }

        // Ambil 1 transaksi paling baru milik pelanggan yang sedang login
        $transaksi = Transaksi::with(['pelanggan', 'admin'])
            ->where('id_pelanggan', $pelangganId)
            ->orderByDesc('tanggal_transaksi')
            ->orderByDesc('id_transaksi')
            ->first();

        $timeline = [];

        if ($transaksi) {
            $daftarStatus = ['Menunggu', 'Diproses', 'Dicuci', 'Disetrika', 'Selesai', 'Diambil'];
            $statusSekarang = $transaksi->status_laundry ?? 'Menunggu';

            $currentIndex = array_search($statusSekarang, $daftarStatus);
            if ($currentIndex === false) {
                $currentIndex = 0;
            }

            $waktuRef = $transaksi->updated_at ?? $transaksi->tanggal_transaksi ?? now();

            foreach ($daftarStatus as $index => $status) {
                $selesai = $index <= $currentIndex;
                $aktif = $index === $currentIndex;

                $timeline[] = [
                    'status'  => $status,
                    'waktu'   => $selesai ? date('d M Y - H:i', strtotime($waktuRef)) : '-',
                    'selesai' => $selesai,
                    'aktif'   => $aktif,
                ];
            }
        }

        return view('PelangganOnly.StatusView', compact('pelanggan', 'transaksi', 'timeline'));
    }
}
