<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Toko Jahit</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('app.css') }}" />
</head>

<body>
    <header>
        <h1>Toko Aksesoris Jahit</h1>
        <nav>
            <a href="/">Dashboard</a>
            <a href="/produk">Produk</a>
            <a href="/transaksi">Transaksi</a>
            <a href="/laporan">Laporan</a>
        </nav>
    </header>

    <div class="container">
        <!-- Dashboard -->
        <div class="card">
            <h2>Dashboard</h2>
            <p>Selamat datang! Berikut ringkasan data toko:</p>
            <ul>
                <li>Total Produk: {{ $totalProduk }}</li>
                <li>Stok Rendah: {{ $stokRendah }} item</li>
                <li>Transaksi Hari Ini: {{ $transaksiHariIni }}</li>
            </ul>
        </div>

        <!-- Laporan Penjualan -->
        <div class="card">
            <h2>
                Laporan Penjualan Terbaru
                <a href="{{ route('laporan.index') }}" style="float: right; font-size: 14px;">Lihat Laporan &rarr;</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Nama Pelanggan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanTerbaru as $laporan)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($laporan->transaksi->transaction_date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $laporan->produk->name }}</td>
                        <td>{{ $laporan->quantity }}</td>
                        <td>{{ $laporan->transaksi->customer_name ?? '-' }}</td>
                        <td>Rp{{ number_format($laporan->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Ringkasan Stok -->
        <div class="card">
            <h2>
                Ringkasan Stok Produk
                <a href="{{ route('produk.index') }}" style="float: right; font-size: 14px;">Lihat Semua Produk
                    &rarr;</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Stok Tersedia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $produk)
                    <tr>
                        <td>{{ $produk->name }}</td>
                        <td>{{ $produk->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
