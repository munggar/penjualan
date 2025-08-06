<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 30px; }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Laporan Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Harga Jual</th>
                <th>Harga Modal</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $trx)
                @foreach ($trx->details as $detail)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($trx->transaction_date)) }}</td>
                        <td>{{ $detail->produk->name ?? '-' }}</td>
                        <td>Rp{{ number_format($detail->price) }}</td>
                        <td>Rp{{ number_format($detail->produk->purchase_price ?? 0) }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp{{ number_format($detail->price * $detail->quantity) }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h4>Ringkasan:</h4>
        <table>
            <tr>
                <td><strong>Total Pendapatan</strong></td>
                <td>Rp{{ number_format($totalPendapatan) }}</td>
            </tr>
            <tr>
                <td><strong>Total Modal</strong></td>
                <td>Rp{{ number_format($totalModal) }}</td>
            </tr>
            <tr>
                <td><strong>Total Biaya Operasional</strong></td>
                <td>Rp{{ number_format($totalBiaya) }}</td>
            </tr>
            <tr>
                <td><strong><u>Laba Bersih</u></strong></td>
                <td><strong>Rp{{ number_format($totalPendapatan - $totalModal - $totalBiaya) }}</strong></td>
            </tr>
        </table>
    </div>

</body>
</html>
