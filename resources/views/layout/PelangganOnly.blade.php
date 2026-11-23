<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clean Wash - Area Pelanggan')</title>
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
    {{-- TOP NAVBAR PELANGGAN --}}
    <header class="cw-header sticky-top no-print mb-4">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between" style="height: 64px;">
                {{-- Logo & Brand --}}
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <a href="#" class="cw-brand">Clean-Wash</a>
                        <p class="cw-subtitle">Layanan Laundry Pelanggan</p>
                    </div>
                </div>

                {{-- Navigasi Desktop --}}
                <nav class="d-none d-md-flex align-items-center gap-1">
                    <a href="{{ url('/') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.home') ? 'active' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.pemesanan.create') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.pemesanan*') ? 'active' : '' }}">
                        Pesan
                    </a>
                    <a href="{{ route('pelanggan.status') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.status') ? 'active' : '' }}">
                        Status
                    </a>
                    <a href="{{ route('pelanggan.riwayat') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.riwayat') ? 'active' : '' }}">
                        Riwayat
                    </a>
                    <a href="{{ route('pelanggan.profil') }}" class="cw-nav-link {{ request()->routeIs('pelanggan.profil*') ? 'active' : '' }}">
                        Profil
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light px-3" style="font-size: 0.8rem;">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        {{-- Mobile Navigasi --}}
        <div class="d-flex d-md-none align-items-center overflow-auto px-3 py-2 cw-mobile-bar gap-2">
            <a href="{{ url('/') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.home') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('pelanggan.pemesanan.create') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.pemesanan*') ? 'active' : '' }}">
                Pesan
            </a>
            <a href="{{ route('pelanggan.status') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.status') ? 'active' : '' }}">
                Status
            </a>
            <a href="{{ route('pelanggan.riwayat') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.riwayat') ? 'active' : '' }}">
                Riwayat
            </a>
            <a href="{{ route('pelanggan.profil') }}" class="cw-mobile-link {{ request()->routeIs('pelanggan.profil*') ? 'active' : '' }}">
                Profil
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline ms-auto">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger py-0 px-2" style="font-size: 0.75rem;">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
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
