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

    <form action="{{ route('status.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="id_transaksi">ID Transaksi</label><br>
            <input type="text" name="id_transaksi" id="id_transaksi" value="{{ old('id_transaksi', request('id_transaksi', $transaksi->id_transaksi ?? '')) }}">
        </div>

        <p id="pesan-transaksi">
            @if (request()->filled('id_transaksi') && !$transaksi)
                Data transaksi tidak ditemukan.
            @endif
        </p>

        <div>
            <label>Status Saat Ini</label><br>
            <span id="status-saat-ini">{{ $statusSekarang ?? '-' }}</span>
            <span id="nama-pelanggan">
                @if ($transaksi && $transaksi->pelanggan)
                    ({{ $transaksi->pelanggan->nama_pelanggan }})
                @endif
            </span>
        </div>

        <div>
            <label for="status_laundry">Ubah Status</label><br>
            <select name="status_laundry" id="status_laundry">
                @foreach ($statusList as $status)
                    <option value="{{ $status }}" {{ old('status_laundry', $statusSekarang) === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Simpan</button>
        </div>
    </form>

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
