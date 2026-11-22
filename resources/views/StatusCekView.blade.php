@extends('layout.app')

@section('title', 'Cek Status Laundry - CleanWash')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Cek Status Transaksi Laundry</h5>
        <a href="{{ route('status.update') }}" class="btn btn-primary btn-sm">Update Status</a>
    </div>

    <div class="card-body">
        {{-- Form Pencarian ID Transaksi --}}
        <form action="{{ route('status.cek') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text">#</span>
                    <input
                        type="text"
                        name="id"
                        class="form-control"
                        placeholder="Masukkan ID Transaksi (contoh: 1)"
                        value="{{ $searchId ?? '' }}"
                        autofocus
                        required
                    >
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Cek Status</button>
                @if(!empty($searchId))
                    <a href="{{ route('status.cek') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        {{-- Hasil Pencarian --}}
        @if(empty($searchId))
            <div class="alert alert-info mb-0">
                Silakan masukkan <strong>ID Transaksi</strong> pada kolom di atas untuk melihat detail dan progres cucian.
            </div>
        @elseif(!$transaksi)
            <div class="alert alert-danger mb-0">
                Transaksi dengan ID <strong>#{{ $searchId }}</strong> tidak ditemukan. Periksa kembali nomor ID transaksi.
            </div>
        @else
            <hr class="my-4">

            <div class="row g-4">
                {{-- Kolom Kiri: Detail Pesanan --}}
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">Informasi Pesanan</h6>
                    <table class="table table-bordered table-sm mb-0">
                        <tr>
                            <th width="180" class="bg-light">ID Pesanan</th>
                            <td class="fw-bold">#{{ $transaksi->id_transaksi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Pelanggan</th>
                            <td>{{ $transaksi->pelanggan?->nama_pelanggan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">No. Telepon</th>
                            <td>{{ $transaksi->pelanggan?->no_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Masuk</th>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status Saat Ini</th>
                            <td><span class="badge bg-primary">{{ $transaksi->status_laundry }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Metode Pengambilan</th>
                            <td>{{ $transaksi->metode_pengambilan ?? 'Ambil Sendiri' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Admin Pencatat</th>
                            <td>{{ $transaksi->admin?->nama_admin ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Kolom Kanan: Alur Status Pesanan --}}
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">Alur Status Pesanan</h6>
                    <ul class="list-group">
                        @foreach($timeline as $item)
                            @php
                                $isPassedOrActive = $item['selesai'];
                                $isActive = !empty($item['aktif']);
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center {{ $isActive ? 'border-primary bg-primary bg-opacity-10' : '' }}">
                                <div>
                                    <span class="{{ $isPassedOrActive ? 'fw-bold text-dark' : 'text-muted' }}">
                                        {{ $item['status'] }}
                                    </span>
                                    @if($isActive)
                                        <span class="badge bg-primary ms-2">Status Aktif</span>
                                    @endif
                                    <div class="small {{ $isPassedOrActive ? 'text-secondary' : 'text-muted' }}">
                                        Waktu: {{ $item['waktu'] }}
                                    </div>
                                </div>
                                @if($isPassedOrActive)
                                    <span class="badge bg-success rounded-pill">Selesai</span>
                                @else
                                    <span class="badge bg-light text-muted border rounded-pill">Menunggu</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
