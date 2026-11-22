@extends('layout.app')

@section('title', 'Update Status Laundry - CleanWash')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Update Status Transaksi Laundry</h5>
        <a href="{{ route('status.cek') }}" class="btn btn-primary btn-sm">Cek Status</a>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('status.update') }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                {{-- Input ID Transaksi --}}
                <div class="mb-3">
                    <label for="id_transaksi" class="form-label fw-semibold">ID Transaksi</label>
                    <div class="input-group">
                        <span class="input-group-text">#</span>
                        <input
                            type="text"
                            name="id_transaksi"
                            id="id_transaksi"
                            class="form-control"
                            placeholder="Masukkan ID Transaksi (contoh: 1)"
                            value="{{ old('id_transaksi', request('id_transaksi', $transaksi->id_transaksi ?? '')) }}"
                            autofocus
                            required
                        >
                    </div>
                    <div id="pesan-transaksi" class="text-danger small mt-1">
                        @if (request()->filled('id_transaksi') && !$transaksi)
                            Data transaksi tidak ditemukan.
                        @endif
                    </div>
                </div>

                {{-- Info Status Saat Ini --}}
                <div class="mb-3 p-3 bg-light border rounded">
                    <div class="small text-muted mb-1">Status Saat Ini</div>
                    <div class="d-flex align-items-center gap-2">
                        <span id="status-saat-ini" class="badge bg-primary">{{ $statusSekarang ?? '-' }}</span>
                        <span id="nama-pelanggan" class="text-dark fw-medium small">
                            @if ($transaksi && $transaksi->pelanggan)
                                ({{ $transaksi->pelanggan->nama_pelanggan }})
                            @endif
                        </span>
                    </div>
                </div>

                {{-- Pilihan Ubah Status --}}
                <div class="mb-4">
                    <label for="status_laundry" class="form-label fw-semibold">Ubah Status</label>
                    <select name="status_laundry" id="status_laundry" class="form-select">
                        @foreach ($statusList as $status)
                            <option value="{{ $status }}" {{ old('status_laundry', $statusSekarang) === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('status.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputId = document.getElementById('id_transaksi');
        const statusSaatIni = document.getElementById('status-saat-ini');
        const namaPelanggan = document.getElementById('nama-pelanggan');
        const pesanTransaksi = document.getElementById('pesan-transaksi');
        const selectStatus = document.getElementById('status_laundry');
        let timer = null;

        inputId.addEventListener('input', function () {
            clearTimeout(timer);
            const id = inputId.value.trim();

            if (!id) {
                statusSaatIni.textContent = '-';
                namaPelanggan.textContent = '';
                pesanTransaksi.textContent = '';
                return;
            }

            timer = setTimeout(function () {
                fetch(`{{ route('status.index') }}?id_transaksi=${encodeURIComponent(id)}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.found) {
                        statusSaatIni.textContent = data.status_laundry ?? '-';
                        namaPelanggan.textContent = data.nama_pelanggan ? `(${data.nama_pelanggan})` : '';
                        pesanTransaksi.textContent = '';
                        if (data.status_laundry) {
                            selectStatus.value = data.status_laundry;
                        }
                    } else {
                        statusSaatIni.textContent = '-';
                        namaPelanggan.textContent = '';
                        pesanTransaksi.textContent = 'Data transaksi tidak ditemukan.';
                    }
                })
                .catch(() => {
                    pesanTransaksi.textContent = 'Gagal mengambil data transaksi.';
                });
            }, 250);
        });
    });
</script>
@endsection
