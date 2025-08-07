@include('layouts.nav')

<style>
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        background-color: #f5f7fa;
        color: #333;
    }

    /* .container {
        margin: inherit;
    } */

    .card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    h2 {
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    table th {
        background-color: #f9fafb;
    }

    table tfoot {
        background-color: #f3f4f6;
        font-weight: 600;
    }

    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn:hover {
        background-color: #4338ca;
    }

    .form-row {
        margin-bottom: 1rem;
    }

    .form-row label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .form-row input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
    }
    @media (min-width: 768px) {
    form button {
        padding-left: 188px;
        padding-top: 50px;
    }
}
</style>
<div class="container my-5">
    <div class="card my-5">
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
                download="Laporan-Penjualan">Cetak PDF</a>
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
        <form method="GET" action="{{ route('report') }}">
    <button class="btn btn-secondary mb-3" type="submit">Cetak Laporan PDF</button>
</form>

            {{-- <a class="btn btn-secondary mb-3"
                href="{{ route('report') }}"
                download="Laporan-Keuangan">Cetak Laporan PDF</a> --}}
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
                    <td>Total Biaya</td>
                    <td>Rp{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Keuntungan / Kerugian</strong></td>
                    <td>
                        @php
                        $selisih = $totalPendapatan - $totalModal - $totalBiaya;
                        @endphp
                        <strong style="color: {{ $selisih > 0 ? 'green' : 'red' }}">
                            Rp{{ number_format($selisih, 0, ',', '.') }}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
