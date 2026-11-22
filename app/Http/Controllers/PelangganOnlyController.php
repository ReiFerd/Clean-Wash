<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganOnlyController extends Controller
{
    private array $metodeList = ['Ambil Sendiri', 'Diantar'];

    private function authenticatedPelanggan()
    {
        $pelangganId = session('pelanggan_id');

        if (!$pelangganId || session('role') !== 'pelanggan') {
            return null;
        }

        return Pelanggan::find($pelangganId);
    }

    public function profil()
    {
        $pelanggan = $this->authenticatedPelanggan();

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelanggan terlebih dahulu.');
        }

        return view('PelangganOnly.ProfilView', compact('pelanggan'));
    }

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

    public function createPemesanan()
    {
        $pelanggan = $this->authenticatedPelanggan();

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelanggan terlebih dahulu.');
        }

        $layanans   = Layanan::orderBy('nama_layanan')->get();
        $metodeList = $this->metodeList;

        return view('PelangganOnly.PemesananView', compact('pelanggan', 'layanans', 'metodeList'));
    }

    public function storePemesanan(Request $request)
    {
        $pelanggan = $this->authenticatedPelanggan();

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelanggan terlebih dahulu.');
        }

        $request->validate([
            'id_layanan'         => 'required|exists:layanan,id_layanan',
            'berat_cucian'       => 'required|numeric|min:0.1|max:999',
            'tanggal_transaksi'  => 'required|date',
            'metode_pengambilan' => 'required|in:Ambil Sendiri,Diantar',
        ]);

        $admin = Admin::first();
        if (!$admin) {
            return back()->withInput()->withErrors(['id_layanan' => 'Data admin belum tersedia. Silakan hubungi admin.']);
        }

        // total dihitung ulang di server supaya tidak bisa dimanipulasi dari browser
        $layanan = Layanan::findOrFail($request->id_layanan);
        $total   = round($request->berat_cucian * $layanan->harga_per_kg, 2);

        DB::transaction(function () use ($request, $pelanggan, $admin, $total) {
            $transaksi = Transaksi::create([
                'id_pelanggan'       => $pelanggan->id_pelanggan,
                'id_admin'           => $admin->id_admin,
                'tanggal_transaksi'  => $request->tanggal_transaksi,
                'status_laundry'     => 'Menunggu',
                'metode_pengambilan' => $request->metode_pengambilan,
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_layanan'   => $request->id_layanan,
                'berat_cucian' => $request->berat_cucian,
                'total_harga'  => $total,
            ]);
        });

        return redirect()->route('pelanggan.status')
                         ->with('success', 'Pesanan laundry berhasil dibuat!');
    }

    public function riwayat()
    {
        $pelanggan = $this->authenticatedPelanggan();

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelanggan terlebih dahulu.');
        }

        $riwayatTransaksi = Transaksi::with(['detailTransaksi.layanan'])
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->where('status_laundry', 'Selesai')
            ->orderByDesc('tanggal_transaksi')
            ->orderByDesc('id_transaksi')
            ->get();

        return view('PelangganOnly.RiwayatView', compact('pelanggan', 'riwayatTransaksi'));
    }
}
