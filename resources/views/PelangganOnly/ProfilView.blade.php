@extends('layout.PelangganOnly')

@section('title', 'Profil Saya - Clean Wash')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header text-white py-3 px-4" style="background-color: #0b2545;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-bold">Profil Pelanggan</h5>
                        <small class="text-light opacity-75">Informasi akun Clean-Wash Anda</small>
                    </div>
                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Pelanggan</span>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 pb-4 mb-4 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold fs-4 flex-shrink-0"
                         style="width: 64px; height: 64px; background: linear-gradient(135deg, #0284c7, #0b2545);">
                        {{ strtoupper(substr($pelanggan->nama_pelanggan, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-1 fw-bold text-dark">{{ $pelanggan->nama_pelanggan }}</h5>
                        <p class="mb-0 text-muted small">{{ $pelanggan->username_pelanggan }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold mb-1">Nama Lengkap</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $pelanggan->nama_pelanggan }}"
                               readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold mb-1">Username</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $pelanggan->username_pelanggan }}"
                               readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold mb-1">No. Telepon</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $pelanggan->no_telepon }}"
                               readonly>
                    </div>

                    <div class="col-md-6">
    <label class="form-label text-muted small fw-semibold mb-1">Password</label>
    <input type="text"
           class="form-control bg-light"
           value="Password tersimpan dengan aman"
           readonly>
</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('passwordPelanggan');
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const eyeOpen = document.getElementById('iconEyeOpen');
        const eyeClosed = document.getElementById('iconEyeClosed');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';

                if (isPassword) {
                    passwordInput.setAttribute('type', 'text');
                    eyeOpen.classList.add('d-none');
                    eyeClosed.classList.remove('d-none');
                    toggleBtn.setAttribute('aria-label', 'Sembunyikan password');
                } else {
                    passwordInput.setAttribute('type', 'password');
                    eyeOpen.classList.remove('d-none');
                    eyeClosed.classList.add('d-none');
                    toggleBtn.setAttribute('aria-label', 'Tampilkan password');
                }
            });
        }
    });
</script>
@endpush

