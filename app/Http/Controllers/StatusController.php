<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatusController extends Controller
{
    private array $statusList = [
        'Diproses',
        'Dicuci',
        'Disetrika',
        'Selesai',
        'Dapat Diambil'
    ];

     public function index(Request $request)
    {
        $idTransaksi = $request->input('id_transaksi');
        $transaksi = null;
        $statusSekarang = null;

        if ($idTransaksi && ctype_digit((string) $idTransaksi)) {
            $transaksi = Transaksi::with('pelanggan')->where('id_transaksi', $idTransaksi)->first();
            $statusSekarang = $transaksi?->status_laundry;
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'found' => (bool) $transaksi,
                'id_transaksi' => $transaksi?->id_transaksi,
                'nama_pelanggan' => $transaksi?->pelanggan?->nama_pelanggan,
                'status_laundry' => $statusSekarang,
            ]);
        }

        return view('StatusUpdateView', [
            'statusList' => $this->statusList,
            'transaksi' => $transaksi,
            'statusSekarang' => $statusSekarang,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id_transaksi' => ['required', 'integer', 'exists:transaksi,id_transaksi'],
            'status_laundry' => ['required', 'string', Rule::in($this->statusList)],
        ]);

        $transaksi = Transaksi::where('id_transaksi', $validated['id_transaksi'])->firstOrFail();
        $transaksi->status_laundry = $validated['status_laundry'];
        $transaksi->save();

        return redirect()
            ->route('status.index', ['id_transaksi' => $transaksi->id_transaksi])
            ->with('success', 'Status laundry berhasil diperbarui.');
    }
}
