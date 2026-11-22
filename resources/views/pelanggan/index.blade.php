@extends('layout.app')

@section('title', 'Data Pelanggan - CleanWash')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Data Pelanggan - CleanWash</h5>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">+ Tambah Pelanggan</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alert-notif" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form Pencarian (Sequential Search) -->
            <form action="{{ route('pelanggan.index') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="keyword" class="form-control" 
                           placeholder="Cari nama, no. telepon, atau username..." 
                           value="{{ $keyword ?? '' }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                    @if(!empty($keyword))
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-danger">Reset</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telepon</th>
                            <th>Username</th>
                            <th>Alamat</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $index =>$p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama_pelanggan }}</td>
                                <td>{{ $p->no_telepon }}</td>
                                <td>{{ $p->username_pelanggan }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.show', $p->id_pelanggan) }}" class="btn btn-info btn-sm text-white">Detail</a>
                                    <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Data pelanggan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {$('.form-hapus').on('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')) {
                e.preventDefault();
            }
        });
@endsection
