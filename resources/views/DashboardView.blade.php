<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean-Wash | Informasi Sistem Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/cleanwash.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .cw-header {
            background-color: #0b2545;
            border-bottom: 1px solid #334155;
            z-index: 1030;
        }
        .cw-brand {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            background: linear-gradient(to right, #38bdf8, #67e8f9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }
        .cw-subtitle {
            font-size: 11px;
            color: #cbd5e1;
            font-weight: 500;
            margin-bottom: 0;
        }
        .cw-btn-login {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.625rem;
            padding: 0.45rem 1.1rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: all 0.2s ease;
        }
        .cw-btn-login:hover {
            background: linear-gradient(135deg, #0369a1, #0284c7);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.35);
        }
        .cw-hero {
            background: linear-gradient(135deg, #0b2545 0%, #133b6e 65%, #0284c7 100%);
            color: #ffffff;
            border-radius: 1.25rem;
            padding: 3rem 2.25rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(11, 37, 69, 0.16);
        }
        .cw-hero::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(103, 232, 249, 0.2) 0%, rgba(103, 232, 249, 0) 70%);
            top: -80px;
            right: -60px;
            pointer-events: none;
        }
        .cw-hero-badge {
            display: inline-block;
            background-color: rgba(56, 189, 248, 0.18);
            color: #bae6fd;
            border: 1px solid rgba(103, 232, 249, 0.35);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            margin-bottom: 1rem;
        }
        .cw-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .cw-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }
        .cw-icon-box {
            width: 46px;
            height: 46px;
            border-radius: 0.75rem;
            background-color: #e0f2fe;
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .cw-step-badge {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background-color: #0b2545;
            color: #67e8f9;
            font-weight: 700;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.85rem;
        }
        .cw-service-pill {
            background-color: #f0f9ff;
            color: #0369a1;
            border: 1px solid #bae6fd;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
        }
        .cw-info-panel {
            background-color: #0b2545;
            color: #f1f5f9;
            border-radius: 1rem;
            padding: 1.75rem;
        }
        .cw-section-title {
            font-weight: 700;
            color: #0b2545;
            letter-spacing: -0.02em;
        }
        .cw-footer {
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    {{-- TOP NAVBAR --}}
    <header class="cw-header sticky-top mb-4">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between" style="height: 64px;">
                {{-- Pojok Kiri Atas: Tulisan Clean-Wash --}}
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <a href="{{ url('/') }}" class="cw-brand">{{ $infoLaundry['nama'] }}</a>
                        <p class="cw-subtitle">{{ $infoLaundry['tagline'] }}</p>
                    </div>
                </div>

                {{-- Pojok Kanan Atas: Tombol Login --}}
                <div>
                    <a href="{{ route('login') }}" class="cw-btn-login">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container pb-5">
        {{-- HERO SECTION --}}
        <section class="cw-hero mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="cw-hero-badge">Layanan Laundry Modern &amp; Terintegrasi</span>
                    <h1 class="display-6 fw-bold mb-3">
                        Solusi Cuci Bersih, Rapi, dan Terpantau dengan {{ $infoLaundry['nama'] }}
                    </h1>
                    <p class="mb-4 text-light opacity-75" style="max-width: 640px;">
                        {{ $infoLaundry['deskripsi'] }}
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('status.cek') }}" class="btn btn-info text-dark fw-semibold px-4 py-2 rounded-3">
                            Cek Status Laundry
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light fw-semibold px-4 py-2 rounded-3">
                            Masuk ke Sistem
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white bg-opacity-10 border border-white border-opacity-25 rounded-4 p-3">
                        <p class="small text-info fw-semibold mb-2">RINGKASAN OPERASIONAL</p>
                        <ul class="list-unstyled mb-0 small">
                            <li class="d-flex justify-content-between py-2 border-bottom border-white border-opacity-10">
                                <span class="opacity-75">Jam Buka</span>
                                <span class="fw-semibold text-end">{{ $infoLaundry['jam_operasional'] }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom border-white border-opacity-10">
                                <span class="opacity-75">Reguler</span>
                                <span class="fw-semibold">{{ $infoLaundry['estimasi_reguler'] }}</span>
                            </li>
                            <li class="d-flex justify-content-between pt-2">
                                <span class="opacity-75">Express</span>
                                <span class="fw-semibold">{{ $infoLaundry['estimasi_express'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- CARD KEUNGGULAN SISTEM --}}
        <section class="mb-5">
            <div class="mb-3">
                <h2 class="h4 cw-section-title mb-1">Mengapa Memilih {{ $infoLaundry['nama'] }}?</h2>
                <p class="text-secondary small mb-0">Informasi umum mengenai layanan dan kemudahan sistem informasi laundry kami.</p>
            </div>
            <div class="row g-3">
                @foreach($keunggulan as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="cw-card p-4">
                            <div class="cw-icon-box">
                                @if($item['ikon'] === 'clock')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                    </svg>
                                @elseif($item['ikon'] === 'shield')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524z"/>
                                    </svg>
                                @elseif($item['ikon'] === 'receipt')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27M4 5.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828z"/>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="h6 fw-bold text-dark mb-2">{{ $item['judul'] }}</h3>
                            <p class="small text-secondary mb-0">{{ $item['deskripsi'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- CARD INFORMASI LAYANAN LAUNDRY --}}
        <section class="mb-5">
            <div class="mb-3">
                <h2 class="h4 cw-section-title mb-1">Informasi Layanan Laundry</h2>
                <p class="text-secondary small mb-0">Pilihan paket perawatan pakaian yang tersedia di {{ $infoLaundry['nama'] }}.</p>
            </div>
            <div class="row g-3">
                @foreach($layananUmum as $layanan)
                    <div class="col-md-6 col-lg-3">
                        <div class="cw-card p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                    <h3 class="h6 fw-bold text-dark mb-0">{{ $layanan['nama'] }}</h3>
                                    <span class="cw-service-pill">{{ $layanan['badge'] }}</span>
                                </div>
                                <p class="small text-secondary mb-3">{{ $layanan['keterangan'] }}</p>
                            </div>
                            <div class="pt-2 border-top d-flex justify-content-between align-items-center small">
                                <span class="text-muted">Estimasi</span>
                                <span class="fw-semibold text-primary">{{ $layanan['estimasi'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ALUR PROSES & INFORMASI KONTAK --}}
        <section class="row g-4 align-items-stretch">
            <div class="col-lg-8">
                <div class="cw-card p-4">
                    <h2 class="h5 cw-section-title mb-1">Alur Proses Laundry</h2>
                    <p class="text-secondary small mb-4">Tahapan pengerjaan pakaian hingga siap diambil oleh pelanggan.</p>
                    <div class="row g-3">
                        @foreach($alurLaundry as $alur)
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="cw-step-badge">{{ $alur['langkah'] }}</span>
                                    <h3 class="h6 fw-bold mb-1">{{ $alur['judul'] }}</h3>
                                    <p class="small text-secondary mb-0">{{ $alur['deskripsi'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cw-info-panel h-100 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-info text-dark mb-3">Informasi Outlet</span>
                        <h2 class="h5 fw-bold mb-2">Butuh Bantuan atau Cek Cucian?</h2>
                        <p class="small text-light opacity-75 mb-4">
                            Hubungi kami atau pantau status laundry Anda secara langsung melalui halaman cek status.
                        </p>
                        <div class="small mb-3">
                            <div class="text-info fw-semibold">Alamat</div>
                            <div>{{ $infoLaundry['alamat'] }}</div>
                        </div>
                        <div class="small mb-3">
                            <div class="text-info fw-semibold">Telepon / WhatsApp</div>
                            <div>{{ $infoLaundry['telepon'] }}</div>
                        </div>
                        <div class="small mb-4">
                            <div class="text-info fw-semibold">Jam Operasional</div>
                            <div>{{ $infoLaundry['jam_operasional'] }}</div>
                        </div>
                    </div>
                    <a href="{{ route('status.cek') }}" class="btn btn-info text-dark fw-semibold w-100 rounded-3">
                        Cek Status Cucian Sekarang
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="cw-footer py-4 bg-white">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} <strong>{{ $infoLaundry['nama'] }}</strong> — {{ $infoLaundry['tagline'] }}</span>
            <span>Akses Publik Dashboard Informasi</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
