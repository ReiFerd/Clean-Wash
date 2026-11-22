@extends('layout.PelangganOnly')

@section('title', 'Riwayat Transaksi - Clean Wash')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold text-dark mb-1">Riwayat Transaksi Laundry</h5>
                        <p class="text-muted small mb-0">Daftar transaksi Anda yang telah selesai diproses.</p>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                        Status: Selesai
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center py-3" style="width: 50px;">No</th>
                                <th scope="col" class="py-3">Tanggal Transaksi</th>
                                <th scope="col" class="py-3">Jenis Layanan</th>
                                <th scope="col" class="text-center py-3">Berat</th>
                                <th scope="col" class="text-end py-3 pe-4">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatTransaksi as $transaksi)
                                @php
                                    $detailList = $transaksi->detailTransaksi;
                                    $totalTransaksi = $detailList->sum('total_harga');
                                    $totalBerat = $detailList->sum('berat_cucian');
                                    $layananNames = $detailList->map(function($detail) {
                                        return $detail->layanan->nama_layanan ?? '-';
                                    })->filter()->unique()->implode(', ');
                                @endphp
                                <tr>
                                    <td class="text-center fw-semibold text-secondary">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-medium text-dark">
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d F Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            {{ $layananNames ?: '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted">
                                        {{ number_format($totalBerat, 1, ',', '.') }} kg
                                    </td>
                                    <td class="text-end pe-4 fw-bold text-dark">
                                        Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="py-3">
                                            <p class="mb-1 fw-medium">Belum ada riwayat transaksi yang selesai.</p>
                                            <p class="small text-secondary mb-0">Transaksi yang telah selesai akan otomatis muncul di halaman ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
