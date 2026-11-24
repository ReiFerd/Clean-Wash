@extends('layout.PelangganOnly')

@section('title', 'Pembayaran - CleanWash')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="fw-bold text-dark">Pembayaran Laundry</h3>
        <p class="text-muted mb-0">Lihat tagihan dan lakukan konfirmasi pembayaran pesananmu.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data pembayaran:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @forelse($pembayaran as $item)
        @php
            $transaksi = $item->transaksi;
            $status = $item->status_pembayaran;

            $statusLabel = [
                'belum_dibayar' => 'Belum Dibayar',
                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                'sudah_dibayar' => 'Sudah Dibayar',
                'ditolak' => 'Ditolak',
            ];

            $statusClass = [
                'belum_dibayar' => 'bg-warning text-dark',
                'menunggu_verifikasi' => 'bg-info text-dark',
                'sudah_dibayar' => 'bg-success',
                'ditolak' => 'bg-danger',
            ];
        @endphp

        <div class="card cw-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">Tagihan #{{ $item->id_pembayaran }}</h5>
                    <small>Transaksi #{{ $transaksi->id_transaksi ?? '-' }}</small>
                </div>
                <span class="badge {{ $statusClass[$status] ?? 'bg-secondary' }}">
                    {{ $statusLabel[$status] ?? $status }}
                </span>
            </div>

            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Detail Pesanan</h6>

                @php
                    $total = 0;
                @endphp

                @if($transaksi && $transaksi->detailTransaksi)
                    @foreach($transaksi->detailTransaksi as $detail)
                        @php
                            $total += $detail->total_harga;
                        @endphp

                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">
                                    {{ $detail->layanan->nama_layanan ?? $detail->layanan->nama ?? 'Layanan Laundry' }}
                                </div>
                                <small class="text-muted">
                                    Berat: {{ $detail->berat_cucian }} kg
                                </small>
                            </div>
                            <span class="fw-semibold">
                                Rp{{ number_format($detail->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Detail pesanan tidak tersedia.</p>
                @endif

                <div class="total-box mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Total Pembayaran</span>
                        <span class="total-angka">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="fw-bold">Informasi Pembayaran</h6>
                    <p class="mb-1">
                        Metode:
                        <strong>{{ $item->metode_pembayaran }}</strong>
                    </p>
                    <p class="mb-1">
                        Tanggal:
                        {{ $item->tanggal_pembayaran ? \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y') : '-' }}
                    </p>

                    @if($item->bukti_pembayaran)
                        <p class="mb-0">
                            Bukti pembayaran:
                            <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank">
                                Lihat bukti
                            </a>
                        </p>
                    @endif
                </div>

                @if(in_array($status, ['belum_dibayar', 'ditolak']))
                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Konfirmasi Pembayaran</h6>

                    <form action="{{ route('pelanggan.pembayaran.konfirmasi', $item->id_pembayaran) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select metode-pembayaran" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>

                        <div class="mb-3 bukti-transfer d-none">
                            <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                            <input type="file"
                                   name="bukti_pembayaran"
                                   class="form-control input-bukti"
                                   accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Format JPG, JPEG, atau PNG. Maksimal 2 MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Kirim Konfirmasi Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="card cw-card">
            <div class="card-body text-center py-5">
                <h5 class="fw-bold">Belum Ada Tagihan</h5>
                <p class="text-muted mb-0">Tagihan pembayaran akan muncul setelah kamu membuat pesanan laundry.</p>
            </div>
        </div>
    @endforelse
</div>

<style>
    .cw-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.08);
        overflow: hidden;
    }

    .cw-card .card-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #fff;
        padding: 1rem 1.25rem;
        border-bottom: none;
    }

    .total-box {
        background-color: #f8faff;
        border: 1px dashed #86b7fe;
        border-radius: 10px;
        padding: 1rem 1.25rem;
    }

    .total-angka {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0d6efd;
    }
</style>

<script>
document.querySelectorAll('.metode-pembayaran').forEach(function(select) {
    select.addEventListener('change', function() {
        const form = this.closest('form');
        const bukti = form.querySelector('.bukti-transfer');
        const input = form.querySelector('.input-bukti');

        if (this.value === 'Transfer') {
            bukti.classList.remove('d-none');
            input.required = true;
        } else {
            bukti.classList.add('d-none');
            input.required = false;
            input.value = '';
        }
    });
});
</script>
@endsection