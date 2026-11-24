@extends('layout.PelangganOnly')

@section('content')
<div class="container py-4">

    <div class="p-4 p-md-5 rounded-4 mb-4 text-white"
         style="background: linear-gradient(120deg, #0d6efd, #164b9b);">
        <h2 class="fw-bold">Selamat Datang, {{ $pelanggan->nama_pelanggan }}!</h2>
        <p>Selamat datang di Clean-Wash. Nikmati layanan laundry yang mudah dan praktis.</p>
        <a href="{{ route('pelanggan.pemesanan.create') }}"
           class="btn btn-light text-primary fw-bold px-4">
            Pesan Laundry Sekarang
        </a>
    </div>

    <h4 class="fw-bold mb-3">Layanan Pelanggan</h4>

    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pelanggan.pemesanan.create') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">🧺</div>
                        <h5 class="fw-bold">Pesan Laundry</h5>
                        <p class="text-muted small">Buat pesanan laundry dan pilih layanan yang tersedia.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pelanggan.status') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">📦</div>
                        <h5 class="fw-bold">Status Pesanan</h5>
                        <p class="text-muted small">Pantau perkembangan proses laundry kamu.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pelanggan.riwayat') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">📋</div>
                        <h5 class="fw-bold">Riwayat Transaksi</h5>
                        <p class="text-muted small">Lihat transaksi laundry yang sudah selesai.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pelanggan.pembayaran') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">💳</div>
                        <h5 class="fw-bold">Pembayaran</h5>
                        <p class="text-muted small">Lihat dan konfirmasi pembayaran pesanan.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <h5 class="fw-bold">Informasi Clean-Wash</h5>
            <p class="text-muted mb-0">
                Pesan laundry, pantau status pesanan, lihat riwayat transaksi,
                dan kelola pembayaran melalui satu halaman.
            </p>
        </div>
    </div>

</div>
@endsection
