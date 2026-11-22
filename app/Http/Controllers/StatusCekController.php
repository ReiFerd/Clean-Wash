<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class StatusCekController extends Controller
{
    public function index(Request $request, $id = null)
    {
        // Ambil ID dari form pencarian (?id=...) atau parameter URL (/status-cek/{id})
        $rawId = $id ?? $request->query('id');
        $searchId = $rawId ? ltrim(trim((string) $rawId), '#') : null;

        $transaksi = null;
        $timeline = [];

        if ($searchId !== null && $searchId !== '') {
            $transaksi = Transaksi::with(['pelanggan', 'admin', 'detailTransaksi', 'pembayaran'])
                ->find($searchId);

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
        }

        return view('StatusCekView', compact('transaksi', 'timeline', 'searchId'));
    }
}
