@extends('layout.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Detail Informasi Pelanggan</h5>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th width="220">ID Pelanggan</th>
                    <td>{{ $pelanggan->id_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $pelanggan->no_telepon }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pelanggan->alamat }}</td>
                </tr>
                <tr>
                    <th>Username Akun</th>
                    <td>{{ $pelanggan->username_pelanggan }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection