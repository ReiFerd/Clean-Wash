<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clean Wash')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/cleanwash.css') }}" rel="stylesheet">
    <style>
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
        .cw-nav-link {
            color: #f1f5f9;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
        }
        .cw-nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .cw-nav-link.active {
            color: #ffffff;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
        }
        .cw-mobile-bar {
            background-color: #0b2545;
            border-top: 1px solid #334155;
        }
        .cw-mobile-link {
            color: #f1f5f9;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            white-space: nowrap;
        }
        .cw-mobile-link.active {
            background-color: #0284c7;
            color: #ffffff;
            font-weight: 600;
        }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    {{-- TOP NAVBAR --}}
    <header class="cw-header sticky-top no-print mb-4">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between" style="height: 64px;">
                {{-- Logo & Brand --}}
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <a href="{{ url('#') }}" class="cw-brand">Clean-Wash</a>
                        <p class="cw-subtitle">Sistem Informasi Manajemen Laundry</p>
                    </div>
                </div>

                {{-- Navigasi Desktop --}}
                <nav class="d-none d-md-flex align-items-center gap-1">
                    <a href="{{ url('/') }}" class="cw-nav-link {{ request()->is('/') ? 'active' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.index') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                        Daftar Pelanggan
                    </a>
                    <a href="{{ route('pemesanan.index') }}" class="cw-nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        Pesanan
                    </a>
                    <a href="{{ route('status.cek') }}" class="cw-nav-link {{ request()->routeIs('status.cek') ? 'active' : '' }}">
                        Status
                    </a>
                    <a href="{{ route('laporan.index') }}" class="cw-nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        Laporan Keuangan
                    </a>
                </nav>
            </div>
        </div>

        {{-- Mobile Navigasi --}}
        <div class="d-flex d-md-none overflow-auto px-3 py-2 cw-mobile-bar gap-2">
            <a href="{{ url('/') }}" class="cw-mobile-link {{ request()->is('/') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('pelanggan.index') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                Daftar Pelanggan
            </a>
            <a href="{{ route('pemesanan.index') }}" class="cw-mobile-link {{ request()->routeIs('pemesanan.*') ? 'active' : '' }}">
                Pesanan
            </a>
            <a href="{{ route('status.cek') }}" class="cw-mobile-link {{ request()->routeIs('status.cek') ? 'active' : '' }}">
                Status
            </a>
            <a href="{{ route('laporan.index') }}" class="cw-mobile-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                Laporan Keuangan
            </a>
        </div>
    </header>

    <main class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
