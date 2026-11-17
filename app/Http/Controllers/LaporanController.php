<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Daftar status laundry standar di Clean-Wash.
     */
    private array $statusList = [
        'Diproses',
        'Dicuci',
        'Disetrika',
        'Selesai',
        'Dapat Diambil',
    ];

    /**
     * Menampilkan dashboard laporan pendapatan dan riwayat transaksi.
     */
    public function index(Request $request)
    {
        // 1. Ambil input filter
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $statusLaundry = $request->input('status_laundry');
        $search = $request->input('search');

        // Normalisasi tanggal jika pengguna mengisi terbalik (tanggal mulai > tanggal akhir)
        if ($tanggalMulai && $tanggalAkhir && $tanggalMulai > $tanggalAkhir) {
            $temp = $tanggalMulai;
            $tanggalMulai = $tanggalAkhir;
            $tanggalAkhir = $temp;
        }

        // 2. Siapkan query transaksi dengan eager loading relasi dan sum detail_transaksi
        $query = Transaksi::query()
            ->with([
                'pelanggan',
                'detailTransaksi.layanan',
                'pembayaran',
            ])
            ->withSum('detailTransaksi as total_harga_transaksi', 'total_harga');

        // 3. Terapkan filter tanggal (Berdasarkan tanggal_transaksi)
        if ($tanggalMulai) {
            $query->whereDate('tanggal_transaksi', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->whereDate('tanggal_transaksi', '<=', $tanggalAkhir);
        }

        // 4. Terapkan filter status laundry (opsional)
        if ($statusLaundry && in_array($statusLaundry, $this->statusList)) {
            $query->where('status_laundry', $statusLaundry);
        }

        // 5. Terapkan filter pencarian nama pelanggan atau ID transaksi (opsional)
        if ($search) {
            $cleanSearch = trim($search);
            $query->where(function ($q) use ($cleanSearch) {
                $q->where('id_transaksi', 'like', "%{$cleanSearch}%")
                  ->orWhereHas('pelanggan', function ($qp) use ($cleanSearch) {
                      $qp->where('nama_pelanggan', 'like', "%{$cleanSearch}%")
                         ->orWhere('no_telepon', 'like', "%{$cleanSearch}%");
                  });
            });
        }

        // 6. Dapatkan ID seluruh transaksi yang memenuhi kriteria filter (ID unik)
        $filteredIds = (clone $query)->pluck('id_transaksi');

        // 7. Perhitungan Statistik Laporan:
        // - Jumlah transaksi unik
        $totalTransaksi = $filteredIds->count();

        // - Total pendapatan dihitung dari SUM(detail_transaksi.total_harga)
        $totalPendapatan = 0;
        $totalBeratCucian = 0;

        if ($totalTransaksi > 0) {
            $totalPendapatan = (float) DetailTransaksi::whereIn('id_transaksi', $filteredIds)
                ->sum('total_harga');

            $totalBeratCucian = (float) DetailTransaksi::whereIn('id_transaksi', $filteredIds)
                ->sum('berat_cucian');
        }

        // - Rata-rata pendapatan per transaksi
        $rataRataTransaksi = $totalTransaksi > 0
            ? ($totalPendapatan / $totalTransaksi)
            : 0;

        // - Ringkasan status transaksi
        $statusCounts = [];
        foreach ($this->statusList as $st) {
            $statusCounts[$st] = 0;
        }

        if ($totalTransaksi > 0) {
            $countsFromDb = Transaksi::whereIn('id_transaksi', $filteredIds)
                ->select('status_laundry', DB::raw('count(*) as total'))
                ->groupBy('status_laundry')
                ->pluck('total', 'status_laundry')
                ->toArray();

            foreach ($countsFromDb as $st => $count) {
                $statusCounts[$st] = $count;
            }
        }

        // Transaksi yang telah selesai / siap diambil
        $transaksiSelesai = ($statusCounts['Selesai'] ?? 0) + ($statusCounts['Dapat Diambil'] ?? 0);

        // 8. Format informasi periode laporan
        $periodeInfo = 'Semua Waktu';
        if ($tanggalMulai && $tanggalAkhir) {
            $periodeInfo = Carbon::parse($tanggalMulai)->locale('id')->isoFormat('D MMMM Y')
                . ' s/d '
                . Carbon::parse($tanggalAkhir)->locale('id')->isoFormat('D MMMM Y');
        } elseif ($tanggalMulai) {
            $periodeInfo = 'Mulai ' . Carbon::parse($tanggalMulai)->locale('id')->isoFormat('D MMMM Y');
        } elseif ($tanggalAkhir) {
            $periodeInfo = 'Hingga ' . Carbon::parse($tanggalAkhir)->locale('id')->isoFormat('D MMMM Y');
        }

        // 9. Ambil riwayat transaksi dengan pagination (10 per halaman) & urutan terbaru
        $riwayatTransaksi = $query
            ->orderBy('tanggal_transaksi', 'desc')
            ->orderBy('id_transaksi', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan.index', [
            'riwayatTransaksi'  => $riwayatTransaksi,
            'totalPendapatan'   => $totalPendapatan,
            'totalTransaksi'    => $totalTransaksi,
            'rataRataTransaksi' => $rataRataTransaksi,
            'totalBeratCucian'  => $totalBeratCucian,
            'transaksiSelesai'  => $transaksiSelesai,
            'statusCounts'      => $statusCounts,
            'statusList'        => $this->statusList,
            'periodeInfo'       => $periodeInfo,
            'filterTanggalMulai'=> $tanggalMulai,
            'filterTanggalAkhir'=> $tanggalAkhir,
            'filterStatus'      => $statusLaundry,
            'filterSearch'      => $search,
        ]);
    }
}
