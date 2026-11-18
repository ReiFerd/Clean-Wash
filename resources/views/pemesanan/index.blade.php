@extends('layout.cleanwash')
@section('title', 'Data Pemesanan - CleanWash')

@section('content')
<div class="card cw-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Pemesanan Laundry</h5>
        <a href="{{ route('pemesanan.create') }}" class="btn btn-primary btn-sm">+ Buat Pesanan</a>
    </div>
    <div class="card-body">
        <form action="{{ route('pemesanan.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text" name="keyword" class="form-control" placeholder="Cari nama pelanggan atau ID pesanan..." value="{{ $keyword }}">
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary">Cari</button>
                @if($keyword)<a href="{{ route('pemesanan.index') }}" class="btn btn-outline-danger">Reset</a>@endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr><th>ID</th><th>Pelanggan</th><th>Layanan</th><th>Berat</th><th>Total</th><th>Tanggal</th><th>Status</th><th width="210">Aksi</th></tr>
                </thead>
                <tbody>
                @forelse($pemesanans as $p)
                    @php $d = $p->detailTransaksi->first(); @endphp
                    <tr>
                        <td>#{{ $p->id_transaksi }}</td>
                        <td>{{ $p->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $d->layanan->nama_layanan ?? '-' }}</td>
                        <td>{{ $d ? (float) $d->berat_cucian : 0 }} kg</td>
                        <td>Rp {{ number_format($d->total_harga ?? 0, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_transaksi)->format('d M Y') }}</td>
                        <td><span class="badge bg-primary badge-status">{{ $p->status_laundry }}</span></td>
                        <td>
                            <a href="{{ route('pemesanan.show', $p->id_transaksi) }}" class="btn btn-info btn-sm text-white">Detail</a>
                            <a href="{{ route('pemesanan.edit', $p->id_transaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemesanan.destroy', $p->id_transaksi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">Belum ada data pemesanan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection