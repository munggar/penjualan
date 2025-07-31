<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Toko Jahit</title>

    <!-- Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 1rem 2rem;
            margin-bottom: 2rem;
        }

        header h1 {
            margin: 0;
        }

        header nav a {
            color: white;
            margin-right: 1rem;
            text-decoration: none;
            font-weight: 500;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center">
        <h1 class="h4">Toko Aksesoris Jahit</h1>
        <nav>
            <a href="/">Dashboard</a>
            <a href="/produk">Produk</a>
            <a href="/transaksi">Transaksi</a>
            <a href="/laporan">Laporan</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Dashboard Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Dashboard</h5>
            </div>
            <div class="card-body">
                <p>Selamat datang! Berikut ringkasan data toko:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total Produk: <strong>{{ $totalProduk }}</strong></li>
                    <li class="list-group-item">Stok Rendah: <strong>{{ $stokRendah }} item</strong></li>
                    <li class="list-group-item">Transaksi Hari Ini: <strong>{{ $transaksiHariIni }}</strong></li>
                </ul>
            </div>
        </div>

        <!-- Laporan Penjualan -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan Penjualan Terbaru</h5>
                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Laporan &rarr;</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
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
            </div>
        </div>

        <!-- Ringkasan Stok -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ringkasan Stok Produk</h5>
                <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Produk &rarr;</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
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
        </div>
    </div>
</body>

</html>
