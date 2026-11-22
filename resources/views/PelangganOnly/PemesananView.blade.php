@extends('PelangganOnly')
@section('title', 'Buat Pesanan - CleanWash')

@section('content')
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
    .cw-pelanggan-box {
        background-color: #f0f6ff;
        border: 1px solid #cfe2ff;
        border-radius: 10px;
        padding: 0.85rem 1rem;
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

<div class="card cw-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Buat Pesanan Laundry</h5>
        <a href="{{ route('pelanggan.status') }}" class="btn btn-light btn-sm text-primary fw-semibold">Lihat Status Pesanan</a>
    </div>
    <div class="card-body p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cw-pelanggan-box mb-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <div class="text-muted small">Pemesan (Akun Login)</div>
                <div class="fw-bold text-dark">{{ $pelanggan->nama_pelanggan }}</div>
            </div>
            <div class="text-md-end">
                <div class="text-muted small">No. Telepon</div>
                <div class="fw-semibold text-primary">{{ $pelanggan->no_telepon }}</div>
            </div>
        </div>

        <form action="{{ route('pelanggan.pemesanan.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id_layanan" class="form-label fw-semibold">Jenis Layanan</label>
                    <select name="id_layanan" id="id_layanan" class="form-select" required>
                        <option value="">-- Pilih layanan --</option>
                        @foreach($layanans as $l)
                            <option value="{{ $l->id_layanan }}" data-harga="{{ $l->harga_per_kg }}"
                                {{ old('id_layanan') == $l->id_layanan ? 'selected' : '' }}>
                                {{ $l->nama_layanan }} - Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="berat_cucian" class="form-label fw-semibold">Berat Pakaian (kg)</label>
                    <input type="number" step="0.1" min="0.1" max="999" name="berat_cucian" id="berat_cucian" class="form-control"
                           value="{{ old('berat_cucian') }}" placeholder="contoh: 3.5" required>
                </div>

                <div class="col-md-6">
                    <label for="tanggal_transaksi" class="form-label fw-semibold">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                           value="{{ old('tanggal_transaksi', date('Y-m-d')) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="metode_pengambilan" class="form-label fw-semibold">Metode Pengambilan</label>
                    <select name="metode_pengambilan" id="metode_pengambilan" class="form-select" required>
                        @foreach($metodeList as $m)
                            <option value="{{ $m }}" {{ old('metode_pengambilan') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <div class="total-box d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Harga per kg</div>
                            <div class="fw-semibold text-dark" id="harga_per_kg">Rp 0</div>
                        </div>
                        <div class="text-end">
                            <div class="text-muted small">Estimasi Total Biaya</div>
                            <div class="total-angka" id="total_biaya">Rp 0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Buat Pesanan</button>
                <a href="{{ route('pelanggan.status') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananSelect = document.getElementById('id_layanan');
        const beratInput = document.getElementById('berat_cucian');
        const hargaEl = document.getElementById('harga_per_kg');
        const totalEl = document.getElementById('total_biaya');

        function formatRupiah(angka) {
            return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
        }

        function hitungTotal() {
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const harga = parseFloat(selectedOption ? selectedOption.getAttribute('data-harga') : 0) || 0;
            const berat = parseFloat(String(beratInput.value).replace(',', '.')) || 0;

            hargaEl.textContent = formatRupiah(harga);
            totalEl.textContent = formatRupiah(harga * berat);
        }

        layananSelect.addEventListener('change', hitungTotal);
        beratInput.addEventListener('input', hitungTotal);
        hitungTotal();
    });
</script>
@endsection
