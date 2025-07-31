<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .no-border td {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .lunas {
            font-size: 24px;
            font-weight: bold;
            color: green;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <table class="no-border">
        <tr>
            <td>Bandung,</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->transaction_date)->format('d / m / Y') }}</td>
        </tr>
        <tr>
            <td>Tuan :</td>
            <td>{{ $transaksi->customer_name }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Di {{ $transaksi->alamat ?? '_________' }}</td>
        </tr>
    </table>

    <br>

    <strong>Nota No:</strong> {{ $transaksi->id }}

    <table>
        <thead>
            <tr>
                <th>NAMA BARANG</th>
                <th>BANYAKNYA</th>
                <th>HARGA</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->details as $detail)
            <tr>
                <td>{{ $detail->produk->name ?? 'Produk Dihapus' }}</td>
                <td>{{ $detail->quantity }} {{ $detail->product->satuan ?? '' }}</td>
                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong>Jumlah Rp</strong></td>
                <td><strong>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table class="no-border">
        <tr>
            <td style="width: 50%;">Tanda terima</td>
            <td>Hormat Kami</td>
        </tr>
        <tr>
            <td style="height: 50px;"></td>
            <td></td>
        </tr>
        <tr>
            <td>.......................</td>
            <td>Wildan</td>
        </tr>
    </table>

</body>

</html>
