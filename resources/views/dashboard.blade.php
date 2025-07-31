@include('layouts.app')

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
                            <td>{{ \Carbon\Carbon::parse($laporan->transaksi->transaction_date)->translatedFormat('d F Y') }}
                            </td>
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
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Produk
                &rarr;</a>
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
