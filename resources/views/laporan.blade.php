@include('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>
<div class="container">
    <div class="card">
        <h2>Filter Laporan</h2>
        <form method="GET" action="{{ route('laporan.index') }}">
            <div class="form-row">
                <label for="tanggal_awal">Dari Tanggal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ request('tanggal_awal') }}">
            </div>
            <div class="form-row">
                <label for="tanggal_akhir">Sampai Tanggal</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
            </div>
            <button class="btn btn-secondary" type="submit">Tampilkan</button>
            <a class="btn btn-secondary"
                href="{{ route('laporan.cetak', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                target="_blank">Cetak PDF</a>
            <a class="btn btn-secondary" href="{{ route('laporan.index') }}">Hapus Filter</a> {{-- Tambahan ini --}}
        </form>

    </div>

    <div class="card">
        <h2>Data Laporan Penjualan</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $item->customer_name }}</td>
                    <td>Rp{{ number_format($item->total_amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Tidak ada data laporan untuk periode ini.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total Pendapatan</th>
                    <th>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="card">
        <h2>Keuntungan & Kerugian</h2>
        <table>
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th>Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Pendapatan</td>
                    <td>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Modal</td>
                    <td>Rp{{ number_format($totalModal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Keuntungan / Kerugian</strong></td>
                    <td>
                        @php
                        $selisih = $totalPendapatan - $totalModal;
                        @endphp
                        <strong style="color: {{ $selisih > 0 ? 'green' : 'red' }}">
                            Rp{{ number_format($selisih, 0, ',', '.') }}
                        </strong>
                        {{-- <strong>
                Rp{{ number_format($totalPendapatan - $totalModal, 0, ',', '.') }}
                        </strong> --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
