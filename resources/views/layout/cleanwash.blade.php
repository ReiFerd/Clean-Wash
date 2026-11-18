<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clean Wash')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/cleanwash.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg cw-navbar navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">CleanWash</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuCw">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuCw">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('pemesanan.*') ? 'active' : '' }}" href="{{ route('pemesanan.index') }}">Pemesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/status') }}">Status</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a></li>
                </ul>
            </div>
        </div>
    </nav>

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