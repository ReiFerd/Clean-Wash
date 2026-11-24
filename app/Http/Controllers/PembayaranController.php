<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pelangganId = session('pelanggan_id');

        if (!$pelangganId || session('role') !== 'pelanggan') {
            return redirect()->route('login');
        }

        $pembayaran = Pembayaran::with([
            'transaksi.detailTransaksi.layanan'
        ])
        ->whereHas('transaksi', function ($query) use ($pelangganId) {
            $query->where('id_pelanggan', $pelangganId);
        })
        ->orderByDesc('id_pembayaran')
        ->get();

        return view('PelangganOnly.PembayaranView', compact('pembayaran'));
    }

    public function konfirmasi(Request $request, $id_pembayaran)
    {
        $pelangganId = session('pelanggan_id');

        if (!$pelangganId || session('role') !== 'pelanggan') {
            return redirect()->route('login');
        }

        $pembayaran = Pembayaran::with('transaksi')
            ->where('id_pembayaran', $id_pembayaran)
            ->whereHas('transaksi', function ($query) use ($pelangganId) {
                $query->where('id_pelanggan', $pelangganId);
            })
            ->firstOrFail();

        if ($pembayaran->status_pembayaran !== 'belum_dibayar') {
            return back()->with('error', 'Pembayaran ini sudah dikonfirmasi sebelumnya.');
        }

        $request->validate([
            'metode_pembayaran' => 'required|in:Tunai,Transfer',
            'bukti_pembayaran' => 'required_if:metode_pembayaran,Transfer|nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bukti = null;

        if ($request->hasFile('bukti_pembayaran')) {
            $bukti = $request->file('bukti_pembayaran')
                ->store('bukti-pembayaran', 'public');
        }

        $pembayaran->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => now()->toDateString(),
            'status_pembayaran' => 'menunggu_verifikasi',
            'bukti_pembayaran' => $bukti,
        ]);

        return redirect()->route('pelanggan.pembayaran')
            ->with('success', 'Konfirmasi pembayaran berhasil dikirim. Silakan tunggu verifikasi admin.');
    }
}