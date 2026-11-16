<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Laundry</title>
</head>
<body>
    <header>
        <h1>Status Laundry</h1>
    </header>

    <main>
        <section>
            <h2>Informasi Pesanan</h2>
            <div>
                <p>ID Pesanan: <span>#{{ $transaksi->id_transaksi }}</span></p>
                <p>Tanggal: <span>{{ $transaksi->tanggal_transaksi }}</span></p>
                <p>Status Saat Ini: <span>{{ $transaksi->status_laundry }}</span></p>
                <p>Metode Pengambilan: <span>{{ $transaksi->metode_pengambilan ?? 'Ambil Sendiri' }}</span></p>
            </div>
        </section>

        <section>
            <h2>Alur Status Pesanan</h2>
            <ol>
                @foreach($timeline as $item)
                    <li>
                        <p><strong>{{ $item['status'] }}</strong></p>
                        <p>Waktu: {{ $item['waktu'] }}</p>
                        @if(!empty($item['aktif']))
                            <p><span>[Status Aktif]</span></p>
                        @endif
                    </li>
                @endforeach
            </ol>
        </section>
    </main>

    <nav>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Pesanan</a></li>
            <li><a href="#"><strong>Status</strong></a></li>
            <li><a href="#">Profil</a></li>
        </ul>
    </nav>
</body>
</html>
