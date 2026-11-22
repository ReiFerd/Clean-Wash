@extends('layout.app')
@section('title', 'Buat Pesanan - CleanWash')

@section('content')
<div class="card cw-card">
    <div class="card-header"><h5 class="mb-0 fw-bold">Buat Pesanan Laundry</h5></div>
    <div class="card-body">
        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf
            @include('pemesanan._form')
            <div class="mt-4">
                <button class="btn btn-primary">Simpan Pesanan</button>
                <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pemesanan.js') }}"></script>
@endpush
