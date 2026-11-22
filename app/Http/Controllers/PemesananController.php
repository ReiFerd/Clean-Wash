<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    private array $metodeList = ['Ambil Sendiri', 'Diantar'];

    private function aturan(): array
    {
        return [
            'id_pelanggan'       => 'required|exists:pelanggan,id_pelanggan',
            'id_layanan'         => 'required|exists:layanan,id_layanan',
            'berat_cucian'       => 'required|numeric|min:0.1|max:999',
            'tanggal_transaksi'  => 'required|date',
            'metode_pengambilan' => 'required|in:Ambil Sendiri,Diantar',
        ];
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $pemesanans = Transaksi::with(['pelanggan', 'detailTransaksi.layanan'])
            ->when($keyword, function ($q) use ($keyword) {
                $q->whereHas('pelanggan', fn ($p) => $p->where('nama_pelanggan', 'like', "%{$keyword}%"))
                  ->orWhere('id_transaksi', $keyword);
            })
            ->orderBy('id_transaksi', 'desc')
            ->get();

        return view('pemesanan.index', compact('pemesanans', 'keyword'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $layanans   = Layanan::orderBy('nama_layanan')->get();
        $metodeList = $this->metodeList;

        return view('pemesanan.create', compact('pelanggans', 'layanans', 'metodeList'));
    }

    public function store(Request $request)
    {
        $request->validate($this->aturan());

        $admin = Admin::first();
        if (!$admin) {
            return back()->withInput()->withErrors(['id_pelanggan' => 'Data admin belum ada. Jalankan php artisan db:seed.']);
        }

        // total dihitung ulang di server supaya tidak bisa dimanipulasi dari browser
        $layanan = Layanan::findOrFail($request->id_layanan);
        $total   = round($request->berat_cucian * $layanan->harga_per_kg, 2);

        $transaksi = DB::transaction(function () use ($request, $admin, $total) {
            $transaksi = Transaksi::create([
                'id_pelanggan'       => $request->id_pelanggan,
                'id_admin'           => $admin->id_admin,
                'tanggal_transaksi'  => $request->tanggal_transaksi,
                'status_laundry'     => 'Diproses',
                'metode_pengambilan' => $request->metode_pengambilan,
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_layanan'   => $request->id_layanan,
                'berat_cucian' => $request->berat_cucian,
                'total_harga'  => $total,
            ]);

            return $transaksi;
        });

        return redirect()->route('pemesanan.show', $transaksi->id_transaksi)
                         ->with('success', 'Pesanan laundry berhasil dibuat!');
    }

    public function show($id)
    {
        $pemesanan = Transaksi::with(['pelanggan', 'pembayaran', 'detailTransaksi.layanan'])->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function edit($id)
    {
        $pemesanan  = Transaksi::with('detailTransaksi')->findOrFail($id);
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $layanans   = Layanan::orderBy('nama_layanan')->get();
        $metodeList = $this->metodeList;

        return view('pemesanan.edit', compact('pemesanan', 'pelanggans', 'layanans', 'metodeList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->aturan());

        $transaksi = Transaksi::findOrFail($id);
        $layanan   = Layanan::findOrFail($request->id_layanan);
        $total     = round($request->berat_cucian * $layanan->harga_per_kg, 2);

        DB::transaction(function () use ($request, $transaksi, $total) {
            $transaksi->update([
                'id_pelanggan'       => $request->id_pelanggan,
                'tanggal_transaksi'  => $request->tanggal_transaksi,
                'metode_pengambilan' => $request->metode_pengambilan,
            ]);

            DetailTransaksi::updateOrCreate(
                ['id_transaksi' => $transaksi->id_transaksi],
                [
                    'id_layanan'   => $request->id_layanan,
                    'berat_cucian' => $request->berat_cucian,
                    'total_harga'  => $total,
                ]
            );
        });

        return redirect()->route('pemesanan.show', $id)
                         ->with('success', 'Pesanan laundry berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        DB::transaction(function () use ($transaksi) {
            $transaksi->pembayaran()->delete();
            $transaksi->detailTransaksi()->delete();
            $transaksi->delete();
        });

        return redirect()->route('pemesanan.index')
                         ->with('success', 'Pesanan laundry berhasil dihapus!');
    }
}
