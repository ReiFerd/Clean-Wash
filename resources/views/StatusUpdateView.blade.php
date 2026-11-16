@extends('layout.app')

@section('content')
    <h1>Update Status Laundry</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if ($transaksi)
        <form action="{{ route('status.update', $transaksi->id_transaksi) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">

            <div>
                <label>ID Transaksi:</label>
                <span>{{ $transaksi->id_transaksi }} - {{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</span>
            </div>

            <div>
                <label>Status Saat Ini:</label>
                <span>{{ $statusSekarang ?? $transaksi->status_laundry }}</span>
            </div>

            <div>
                <label for="status_laundry">Ubah Status:</label>
                <select name="status_laundry" id="status_laundry">
                    @foreach ($statusList as $status)
                        <option value="{{ $status }}" {{ old('status_laundry', $statusSekarang ?? $transaksi->status_laundry) === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit">Simpan</button>
            </div>
        </form>
    @else
        <p>Data transaksi tidak ditemukan.</p>
    @endif
@endsection
