@extends('layout.app')
@section('title', 'Verifikasi Pembayaran - CleanWash')

@section('content')
<div class="card cw-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Verifikasi Pembayaran</h5>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-light btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        <h6 class="fw-bold mb-3">Informasi Pesanan</h6>

        <table class="table table-bordered">
            <tr>
                <th width="35%">ID Pesanan</th>
                <td>#{{ $pemesanan->id_transaksi }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $pemesanan->pelanggan->nama_pelanggan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Layanan</th>
                <td>{{ $pemesanan->detailTransaksi->first()->layanan->nama_layanan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Total Tagihan</th>
                <td>
                    Rp {{ number_format($pemesanan->detailTransaksi->first()->total_harga ?? 0, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ $pembayaran->metode_pembayaran }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td>{{ $pembayaran->tanggal_pembayaran ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ $pembayaran->status_pembayaran }}</td>
            </tr>
        </table>

        <h6 class="fw-bold mt-4 mb-3">Bukti Pembayaran</h6>

        @if($pembayaran->bukti_pembayaran)
            <div class="mb-3">
                <img
                    src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                    alt="Bukti Pembayaran"
                    class="img-fluid rounded border"
                    style="max-width: 450px;"
                >
            </div>
        @else
            <div class="alert alert-info">
                Tidak ada gambar bukti transfer. Pelanggan memilih pembayaran tunai atau belum mengunggah bukti.
            </div>
        @endif

        @if($pembayaran->status_pembayaran === 'menunggu_verifikasi')
            <div class="d-flex gap-2 mt-4">
                <form action="{{ route('pemesanan.verifikasi.terima', $pemesanan->id_transaksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menerima pembayaran ini?')">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        Terima Pembayaran
                    </button>
                </form>

                <form action="{{ route('pemesanan.verifikasi.tolak', $pemesanan->id_transaksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Tolak Pembayaran
                    </button>
                </form>
            </div>
        @else
            <div class="alert alert-secondary mt-4">
                Pembayaran ini sudah diproses dan tidak dapat diverifikasi kembali.
            </div>
        @endif
    </div>
</div>
@endsection