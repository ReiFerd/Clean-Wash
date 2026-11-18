@php $d = isset($pemesanan) ? $pemesanan->detailTransaksi->first() : null; @endphp

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Pelanggan</label>
        <select name="id_pelanggan" class="form-select" required>
            <option value="">-- Pilih pelanggan --</option>
            @foreach($pelanggans as $p)
                <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan', $pemesanan->id_pelanggan ?? '') == $p->id_pelanggan ? 'selected' : '' }}>
                    {{ $p->nama_pelanggan }} ({{ $p->no_telepon }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Jenis Layanan</label>
        <select name="id_layanan" id="id_layanan" class="form-select" required>
            <option value="">-- Pilih layanan --</option>
            @foreach($layanans as $l)
                <option value="{{ $l->id_layanan }}" data-harga="{{ $l->harga_per_kg }}"
                    {{ old('id_layanan', $d->id_layanan ?? '') == $l->id_layanan ? 'selected' : '' }}>
                    {{ $l->nama_layanan }} - Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Berat Pakaian (kg)</label>
        <input type="number" step="0.1" min="0.1" name="berat_cucian" id="berat_cucian" class="form-control"
               value="{{ old('berat_cucian', isset($d) ? (float) $d->berat_cucian : '') }}" placeholder="contoh: 3.5" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Tanggal Pemesanan</label>
        <input type="date" name="tanggal_transaksi" class="form-control"
               value="{{ old('tanggal_transaksi', $pemesanan->tanggal_transaksi ?? date('Y-m-d')) }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Metode Pengambilan</label>
        <select name="metode_pengambilan" class="form-select" required>
            @foreach($metodeList as $m)
                <option value="{{ $m }}" {{ old('metode_pengambilan', $pemesanan->metode_pengambilan ?? '') == $m ? 'selected' : '' }}>{{ $m }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <div class="total-box d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted small">Harga per kg</div>
                <div class="fw-semibold" id="harga_per_kg">Rp 0</div>
            </div>
            <div class="text-end">
                <div class="text-muted small">Total Biaya</div>
                <div class="total-angka" id="total_biaya">Rp 0</div>
            </div>
        </div>
    </div>
</div>