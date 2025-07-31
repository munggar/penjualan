@include('layouts.app')

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="mb-3">🧾 Detail Transaksi</h3>
                <hr>

                <div class="mb-3">
                    <p><strong>🗓️ Tanggal:</strong> {{ $transaksi->transaction_date }}</p>
                    <p><strong>👤 Nama Pelanggan:</strong> {{ $transaksi->customer_name }}</p>
                    <p><strong>💰 Total Harga:</strong> Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}
                    </p>
                </div>

                <h5 class="mt-4">📦 Rincian Produk</h5>
                <table class="table table-sm table-bordered mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->details as $detail)
                        <tr>
                            <td>{{ $detail->produk->name ?? 'Produk Dihapus' }}</td>
                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('transaksi.nota', $transaksi->id) }}" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    🖨️ Cetak Nota Full
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                    {{-- Bagian Pembayaran --}}
                    <h5 class="mt-4">💳 Pembayaran</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Metode:</strong> {{ $transaksi->payment_method === 'langsung' ? 'Bayar Langsung' : 'Cicilan' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Total:</strong> Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Total Dibayar:</strong> Rp {{ number_format($dibayar, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Sisa Tagihan:</strong> Rp {{ number_format($sisa, 0, ',', '.') }}
                        </li>
                    </ul>
                    <div class="mb-3">
                        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank"
                            class="btn btn-primary">🖨️ Cetak Nota dengan Metode Pembayaran</a>

                    {{-- Bagian Cicilan & Sisa Bayar --}}
                    <h5 class="mt-5">💸 Pembayaran</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Total Dibayar:</strong> Rp
                            {{ number_format($dibayar, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Sisa Tagihan:</strong> Rp
                            {{ number_format($sisa, 0, ',', '.') }}
                        </li>
                    </ul>

                    @if ($transaksi->payment_method === 'cicilan')
                    {{-- Pembayaran Cicilan --}}
                    <h6 class="mt-4">➕ Tambah Pembayaran Cicilan</h6>
                    <form action="/transaksi/{id}/cicilan" method="POST" class="row g-2">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                        <div class="col-md-5">
                            <input type="date" name="tanggal_bayar" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <input type="number" name="jumlah_bayar" class="form-control" placeholder="Jumlah Bayar"
                                required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </div>
                    </form>
                    @else
                    <p class="text-muted"><h6 class="mt-4">Pembayaran Sudah Dilakukan Langsung!</h6></p>
                    @endif


                    @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                    <br>

                    {{-- Riwayat Pembayaran --}}
                    @if($transaksi->pembayaran)
                    <h6>🧾 Riwayat Pembayaran</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->pembayaranCicilan as $bayar)
                            <tr>
                                <td>{{ $bayar->tanggal_bayar }}</td>
                                <td>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">Belum ada pembayaran cicilan.</p>
                    @endif

                    {{-- Tombol Kembali --}}
                    <div class="mt-4">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary btn-sm">
                            ← Kembali ke Daftar Transaksi
                        </a>
                    </div>
            </div>
        </div>
    </div>

</body>

</html>
