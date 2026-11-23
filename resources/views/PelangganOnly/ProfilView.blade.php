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
                        <label for="passwordPelanggan" class="form-label text-muted small fw-semibold mb-1">Password</label>
                        <div class="input-group">
                            <input type="password"
                                   id="passwordPelanggan"
                                   class="form-control bg-light"
                                   value="{{ $pelanggan->password_pelanggan }}"
                                   readonly>
                            <button class="btn btn-outline-secondary"
                                    type="button"
                                    id="togglePasswordBtn"
                                    aria-label="Tampilkan password"
                                    title="Tampilkan / Sembunyikan Password">
                                {{-- Ikon Mata Terbuka --}}
                                <svg id="iconEyeOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                                {{-- Ikon Mata Tertutup --}}
                                <svg id="iconEyeClosed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="d-none" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                    <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-muted small fw-semibold mb-1">Alamat</label>
                        <textarea class="form-control bg-light" rows="3" readonly>{{ $pelanggan->alamat }}</textarea>
                    </div>
                </div>
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
