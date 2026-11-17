<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan & Transaksi - Clean-Wash</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    {{-- Fallback CDN Tailwind CSS untuk memastikan tampilan sempurna di Laragon & server lokal --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Instrument Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            500: '#0284c7',
                            600: '#0369a1',
                            700: '#075985',
                        }
                    }
                }
            }
        }
    </script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: white !important;
                color: black !important;
                font-size: 12pt;
            }
            .print-only {
                display: block !important;
            }
            .card-shadow {
                box-shadow: none !important;
                border: 1px solid #e2e8f0 !important;
            }
        }
        .print-only {
            display: none;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">

    {{-- TOP NAVBAR --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-sky-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ url('/') }}" class="text-xl font-bold tracking-tight bg-gradient-to-r from-sky-700 to-cyan-600 bg-clip-text text-transparent">
                            Clean-Wash
                        </a>
                        <p class="text-[11px] text-slate-500 font-medium">Sistem Informasi Manajemen Laundry</p>
                    </div>
                </div>

                {{-- Navigasi Menu --}}
                <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                    <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-slate-100 transition">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.index') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-slate-100 transition">
                        Data Pelanggan
                    </a>
                    <a href="{{ route('status.index') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-slate-100 transition">
                        Update Status
                    </a>
                    <a href="{{ route('status.cek') }}" class="px-3 py-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-slate-100 transition">
                        Cek Status
                    </a>
                    <a href="{{ route('laporan.index') }}" class="px-3 py-2 rounded-lg bg-sky-50 text-sky-700 font-semibold border border-sky-200/60 shadow-xs">
                        Laporan Keuangan
                    </a>
                </nav>

                {{-- Info User / Profil --}}
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-800 border border-sky-200">
                        <span class="w-2 h-2 rounded-full bg-sky-600 animate-pulse"></span>
                        Arya (Laporan)
                    </span>
                </div>
            </div>
        </div>

        {{-- Mobile Navigasi (Tabs ringkas) --}}
        <div class="md:hidden flex overflow-x-auto px-4 py-2 bg-slate-100/70 border-t border-slate-200 text-xs font-medium gap-2">
            <a href="{{ url('/') }}" class="px-3 py-1.5 rounded-md text-slate-600 whitespace-nowrap">Beranda</a>
            <a href="{{ route('pelanggan.index') }}" class="px-3 py-1.5 rounded-md text-slate-600 whitespace-nowrap">Pelanggan</a>
            <a href="{{ route('status.index') }}" class="px-3 py-1.5 rounded-md text-slate-600 whitespace-nowrap">Update Status</a>
            <a href="{{ route('status.cek') }}" class="px-3 py-1.5 rounded-md text-slate-600 whitespace-nowrap">Cek Status</a>
            <a href="{{ route('laporan.index') }}" class="px-3 py-1.5 rounded-md bg-sky-600 text-white font-semibold whitespace-nowrap">Laporan</a>
        </div>
    </header>

    {{-- PRINT HEADER (Hanya muncul saat dicetak) --}}
    <div class="print-only p-6 border-b border-slate-400 mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight">CLEAN-WASH LAUNDRY</h1>
        <p class="text-sm text-slate-600">Laporan Pendapatan dan Riwayat Transaksi</p>
        <p class="text-xs text-slate-500 mt-1">Periode Laporan: <strong>{{ $periodeInfo }}</strong> | Dicetak pada: {{ now()->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB</p>
    </div>

    {{-- MAIN CONTENT WRAPPER --}}
    <main class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">

        {{-- PAGE TITLE & ACTIONS --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">
                        Laporan Pendapatan & Transaksi
                    </h1>
                </div>
                <p class="text-sm text-slate-500 mt-1 flex items-center gap-2">
                    <span>Informasi rekapitulasi keuangan dan riwayat pengerjaan cucian.</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-200/80 text-slate-700">
                        Periode: {{ $periodeInfo }}
                    </span>
                </p>
            </div>

            {{-- Tombol Aksi (Print & Refresh) --}}
            <div class="flex items-center gap-2 no-print">
                <button onclick="window.print()" type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-xs transition active:scale-95">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Laporan / PDF
                </button>
            </div>
        </div>

        {{-- SECTION A: DASHBOARD RINGKASAN & STATISTIK (4 METRIC CARDS) --}}
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            
            {{-- Card 1: Total Pendapatan --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition duration-300 pointer-events-none"></div>
                <div class="flex items-center justify-between mb-3 relative">
                    <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200/50">
                        Total Pendapatan
                    </span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <p class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Akumulasi SUM(total_harga)</span>
                    </p>
                </div>
            </div>

            {{-- Card 2: Jumlah Transaksi Unik --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-sky-50 rounded-full group-hover:scale-110 transition duration-300 pointer-events-none"></div>
                <div class="flex items-center justify-between mb-3 relative">
                    <span class="text-xs font-semibold uppercase tracking-wider text-sky-700 bg-sky-50 px-2.5 py-1 rounded-lg border border-sky-200/50">
                        Jumlah Transaksi
                    </span>
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <p class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($totalTransaksi, 0, ',', '.') }}
                        <span class="text-sm font-semibold text-slate-500 ml-1">Transaksi</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-1">ID transaksi unik terhitung 1x</p>
                </div>
            </div>

            {{-- Card 3: Rata-Rata Transaksi --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-110 transition duration-300 pointer-events-none"></div>
                <div class="flex items-center justify-between mb-3 relative">
                    <span class="text-xs font-semibold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200/50">
                        Rata-Rata Transaksi
                    </span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <p class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-slate-500 mt-1">Rata-rata pendapatan per pesanan</p>
                </div>
            </div>

            {{-- Card 4: Transaksi Selesai & Total Cucian --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-110 transition duration-300 pointer-events-none"></div>
                <div class="flex items-center justify-between mb-3 relative">
                    <span class="text-xs font-semibold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200/50">
                        Pengerjaan Selesai
                    </span>
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <p class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($transaksiSelesai, 0, ',', '.') }}
                        <span class="text-sm font-semibold text-slate-500 ml-1">/ {{ $totalTransaksi }} Selesai</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-1">Total berat cucian: <strong>{{ number_format($totalBeratCucian, 1, ',', '.') }} kg</strong></p>
                </div>
            </div>

        </section>

        {{-- RINGKASAN STATUS LAUNDRY (STATUS BREAKDOWN CHIPS) --}}
        <section class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs mb-8 no-print">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Ringkasan Alur Status Laundry (Sesuai Periode)
                </h3>
                <span class="text-xs text-slate-400">Total berat keseluruhan: {{ number_format($totalBeratCucian, 2, ',', '.') }} kg</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5">
                {{-- Diproses --}}
                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/60">
                    <span class="text-[11px] font-semibold text-amber-800">1. Diproses</span>
                    <p class="text-xl font-bold text-amber-900 mt-0.5">{{ $statusCounts['Diproses'] ?? 0 }}</p>
                </div>
                {{-- Dicuci --}}
                <div class="p-3 rounded-xl bg-blue-50/70 border border-blue-200/60">
                    <span class="text-[11px] font-semibold text-blue-800">2. Dicuci</span>
                    <p class="text-xl font-bold text-blue-900 mt-0.5">{{ $statusCounts['Dicuci'] ?? 0 }}</p>
                </div>
                {{-- Disetrika --}}
                <div class="p-3 rounded-xl bg-indigo-50/70 border border-indigo-200/60">
                    <span class="text-[11px] font-semibold text-indigo-800">3. Disetrika</span>
                    <p class="text-xl font-bold text-indigo-900 mt-0.5">{{ $statusCounts['Disetrika'] ?? 0 }}</p>
                </div>
                {{-- Selesai --}}
                <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-200/60">
                    <span class="text-[11px] font-semibold text-emerald-800">4. Selesai</span>
                    <p class="text-xl font-bold text-emerald-900 mt-0.5">{{ $statusCounts['Selesai'] ?? 0 }}</p>
                </div>
                {{-- Dapat Diambil --}}
                <div class="p-3 rounded-xl bg-teal-50/70 border border-teal-200/60">
                    <span class="text-[11px] font-semibold text-teal-800">5. Dapat Diambil</span>
                    <p class="text-xl font-bold text-teal-900 mt-0.5">{{ $statusCounts['Dapat Diambil'] ?? 0 }}</p>
                </div>
            </div>
        </section>

        {{-- SECTION C: FILTER LAPORAN --}}
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 mb-8 no-print">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                <div>
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter Periode & Riwayat Laporan
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">Saring transaksi berdasarkan rentang tanggal, status laundry, atau kata kunci pencarian.</p>
                </div>
                @if($filterTanggalMulai || $filterTanggalAkhir || $filterStatus || $filterSearch)
                    <a href="{{ route('laporan.index') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold hover:underline flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>

            <form action="{{ route('laporan.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Input Tanggal Mulai --}}
                    <div>
                        <label for="tanggal_mulai" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            Tanggal Mulai
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                id="tanggal_mulai" 
                                name="tanggal_mulai" 
                                value="{{ $filterTanggalMulai ?? '' }}"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition bg-slate-50/50 hover:bg-white"
                            >
                        </div>
                    </div>

                    {{-- Input Tanggal Akhir --}}
                    <div>
                        <label for="tanggal_akhir" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            Tanggal Akhir
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                id="tanggal_akhir" 
                                name="tanggal_akhir" 
                                value="{{ $filterTanggalAkhir ?? '' }}"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition bg-slate-50/50 hover:bg-white"
                            >
                        </div>
                    </div>

                    {{-- Filter Status Laundry --}}
                    <div>
                        <label for="status_laundry" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            Status Laundry
                        </label>
                        <select 
                            id="status_laundry" 
                            name="status_laundry"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition bg-slate-50/50 hover:bg-white"
                        >
                            <option value="">Semua Status</option>
                            @foreach($statusList as $status)
                                <option value="{{ $status }}" {{ ($filterStatus === $status) ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pencarian Nama Pelanggan / ID Transaksi --}}
                    <div>
                        <label for="search" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            Cari Pelanggan / ID Transaksi
                        </label>
                        <input 
                            type="text" 
                            id="search" 
                            name="search" 
                            placeholder="Contoh: Budi atau 1"
                            value="{{ $filterSearch ?? '' }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition bg-slate-50/50 hover:bg-white"
                        >
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                    <div class="flex items-center gap-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-sky-600 hover:bg-sky-700 text-white shadow-sm shadow-sky-600/30 transition active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Terapkan Filter
                        </button>

                        @if($filterTanggalMulai || $filterTanggalAkhir || $filterStatus || $filterSearch)
                            <a href="{{ route('laporan.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                Reset Filter
                            </a>
                        @endif
                    </div>

                    {{-- Quick Date Presets (Hari ini, Bulan ini) --}}
                    <div class="flex items-center gap-1.5 text-xs">
                        <span class="text-slate-400 font-medium">Pintasan:</span>
                        <a href="{{ route('laporan.index', ['tanggal_mulai' => date('Y-m-d'), 'tanggal_akhir' => date('Y-m-d')]) }}" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium transition">
                            Hari Ini
                        </a>
                        <a href="{{ route('laporan.index', ['tanggal_mulai' => date('Y-m-01'), 'tanggal_akhir' => date('Y-m-t')]) }}" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium transition">
                            Bulan Ini
                        </a>
                    </div>
                </div>
            </form>
        </section>

        {{-- SECTION B: TABEL RIWAYAT TRANSAKSI --}}
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden card-shadow">
            
            {{-- Header Tabel --}}
            <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-50/60">
                <div>
                    <h3 class="text-base font-bold text-slate-900">
                        Daftar Riwayat Transaksi
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Menampilkan transaksi lengkap dengan status dan total rincian biaya.
                    </p>
                </div>
                <div class="text-xs text-slate-500 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200/60 shadow-2xs">
                    Total: <strong class="text-slate-900">{{ $riwayatTransaksi->total() }}</strong> transaksi ditemukan
                </div>
            </div>

            {{-- Table Responsif --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100/70 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-600">
                            <th scope="col" class="py-3.5 px-4 text-center w-16">No</th>
                            <th scope="col" class="py-3.5 px-4">ID Transaksi</th>
                            <th scope="col" class="py-3.5 px-4">Tanggal</th>
                            <th scope="col" class="py-3.5 px-4">Pelanggan</th>
                            <th scope="col" class="py-3.5 px-4">Rincian Layanan & Berat</th>
                            <th scope="col" class="py-3.5 px-4">Metode Pengambilan</th>
                            <th scope="col" class="py-3.5 px-4 text-center">Status Laundry</th>
                            <th scope="col" class="py-3.5 px-4 text-right">Total Biaya</th>
                            <th scope="col" class="py-3.5 px-4 text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($riwayatTransaksi as $index => $trx)
                            <tr class="hover:bg-slate-50/80 transition duration-150">
                                {{-- Nomor Urut --}}
                                <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-medium">
                                    {{ $riwayatTransaksi->firstItem() + $index }}
                                </td>

                                {{-- ID Transaksi --}}
                                <td class="py-3.5 px-4 whitespace-nowrap font-mono font-semibold text-slate-900">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        #TRX-{{ str_pad($trx->id_transaksi, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Tanggal Transaksi --}}
                                <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-600">
                                    <div class="font-medium text-slate-800">
                                        {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->locale('id')->isoFormat('D MMM Y') }}
                                    </div>
                                    <span class="text-[11px] text-slate-400">
                                        {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->locale('id')->diffForHumans() }}
                                    </span>
                                </td>

                                {{-- Nama Pelanggan --}}
                                <td class="py-3.5 px-4">
                                    @if($trx->pelanggan)
                                        <div class="font-semibold text-slate-900">
                                            {{ $trx->pelanggan->nama_pelanggan }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $trx->pelanggan->no_telepon ?? '-' }}
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Pelanggan Umum / Terhapus</span>
                                    @endif
                                </td>

                                {{-- Rincian Layanan & Berat --}}
                                <td class="py-3.5 px-4">
                                    @if($trx->detailTransaksi && $trx->detailTransaksi->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 max-w-xs">
                                            @foreach($trx->detailTransaksi as $detail)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200/60" title="Harga: Rp {{ number_format($detail->total_harga, 0, ',', '.') }}">
                                                    <span>{{ $detail->layanan->nama_layanan ?? 'Layanan' }}</span>
                                                    <span class="text-sky-600 font-semibold">({{ $detail->berat_cucian }} kg)</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum ada detail layanan</span>
                                    @endif
                                </td>

                                {{-- Metode Pengambilan --}}
                                <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-600">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                        @if(stripos($trx->metode_pengambilan, 'antar') !== false || stripos($trx->metode_pengambilan, 'delivery') !== false)
                                            <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        @endif
                                        {{ $trx->metode_pengambilan ?? 'Ambil Sendiri' }}
                                    </span>
                                </td>

                                {{-- Status Laundry --}}
                                <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClass = match($trx->status_laundry) {
                                            'Diproses'      => 'bg-amber-100 text-amber-800 border-amber-200',
                                            'Dicuci'        => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'Disetrika'     => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            'Selesai'       => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                            'Dapat Diambil' => 'bg-teal-100 text-teal-800 border-teal-200',
                                            default         => 'bg-slate-100 text-slate-800 border-slate-200'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                        {{ $trx->status_laundry ?? 'Diproses' }}
                                    </span>
                                </td>

                                {{-- Total Biaya Transaksi --}}
                                <td class="py-3.5 px-4 whitespace-nowrap text-right font-bold text-slate-900">
                                    Rp {{ number_format($trx->total_harga_transaksi ?? 0, 0, ',', '.') }}
                                </td>

                                {{-- Aksi / Link Cek Status --}}
                                <td class="py-3.5 px-4 whitespace-nowrap text-center no-print">
                                    <div class="flex items-center justify-center gap-1">
                                        <a 
                                            href="{{ route('status.cek', $trx->id_transaksi) }}" 
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200/80 transition"
                                            title="Lihat status tracking pengerjaan"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Tracking
                                        </a>
                                        <a 
                                            href="{{ route('status.index', ['id_transaksi' => $trx->id_transaksi]) }}" 
                                            class="inline-flex items-center px-2 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition"
                                            title="Ubah status laundry"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-12 px-4 text-center">
                                    <div class="max-w-sm mx-auto">
                                        <div class="w-14 h-14 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-base font-semibold text-slate-800">Tidak ada data transaksi</h4>
                                        <p class="text-xs text-slate-500 mt-1">
                                            Tidak ditemukan transaksi untuk periode atau filter yang dipilih. Silakan ubah filter tanggal atau klik tombol reset.
                                        </p>
                                        @if($filterTanggalMulai || $filterTanggalAkhir || $filterStatus || $filterSearch)
                                            <div class="mt-4">
                                                <a href="{{ route('laporan.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-sky-600 text-white hover:bg-sky-700 transition">
                                                    Reset Semua Filter
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- Footer Tabel (Total Ringkasan Halaman Ini & Keseluruhan) --}}
                    @if($riwayatTransaksi->count() > 0)
                        <tfoot>
                            <tr class="bg-slate-100/90 font-bold text-slate-900 border-t-2 border-slate-300 text-sm">
                                <td colspan="7" class="py-3 px-4 text-right">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-600">Total Pendapatan (Sesuai Filter):</span>
                                </td>
                                <td class="py-3 px-4 text-right text-emerald-700 font-extrabold text-base whitespace-nowrap">
                                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 no-print"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>

            {{-- PAGINATION CONTAINER --}}
            <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 no-print bg-white">
                <div class="text-xs text-slate-500">
                    Menampilkan <strong class="text-slate-800">{{ $riwayatTransaksi->firstItem() ?? 0 }}</strong> sampai <strong class="text-slate-800">{{ $riwayatTransaksi->lastItem() ?? 0 }}</strong> dari <strong class="text-slate-800">{{ $riwayatTransaksi->total() }}</strong> transaksi
                </div>
                <div class="pagination-wrapper">
                    {{ $riwayatTransaksi->links() }}
                </div>
            </div>

        </section>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200 mt-12 py-6 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:flex sm:justify-between sm:items-center text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} <strong>Clean-Wash</strong> - Sistem Informasi Manajemen Laundry.</p>
            <p class="mt-2 sm:mt-0">Dibuat oleh Tim Pengembang Clean-Wash (May, Kir, Arya, Reyhan).</p>
        </div>
    </footer>

</body>
</html>
