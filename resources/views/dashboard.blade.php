@include('layouts.nav')

<style>
    .card-body::-webkit-scrollbar {
        width: 6px;
    }
    .card-body::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 4px;
    }
</style>


<!-- Main Content -->
<div class="container my-5">
    <!-- Dashboard Card -->
    <div class="card mb-4" style="margin-top: 6%">
        <div class="card-header">
            <h5 class="mb-0">Dashboard</h5>
        </div>
        <div class="card-body">
            <p>Selamat datang! Berikut ringkasan data toko:</p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">Total Produk: <strong>{{ $totalProduk }}</strong></li>
                <li class="list-group-item">Transaksi Hari Ini: <strong>{{ $transaksiHariIni }}</strong></li>
            </ul>

            <!-- Tampilan Stok Rendah -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-exclamation-circle-fill me-2"></i>Stok Rendah</span>
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
                <div class="card-body p-2" style="max-height: 150px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @forelse ($stokRendah as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->name }}
                                <span class="badge bg-danger">{{ $item->stock }} {{ $item->satuan }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-success">Semua stok aman 🎉</li>
                        @endforelse
                    </ul>
                </div>
            </div>
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
                            <td>Rp{{ number_format($laporan->transaksi->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            {{ $laporanTerbaru->links('pagination::bootstrap-5') }}
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
                        @foreach($produk as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
{{ $produk->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
</body>
</html>
