<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 13px;
            margin: 40px;
            color: #333;
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
        }
        .summary-table {
            width: 60%;
            margin: 0 auto;
            margin-top: 40px;
            border: 1px solid #aaa;
        }
        .summary-table tr td:first-child {
            width: 70%;
        }
        .summary-table td {
            font-size: 14px;
        }
        .summary-table tr:last-child td {
            font-weight: bold;
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>

    <h2>Laporan Laba Rugi</h2>

    <table class="summary-table">
        <tr>
            <td>Total Pendapatan</td>
            <td>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Modal Produk</td>
            <td>Rp{{ number_format($totalModal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Biaya Operasional</td>
            <td>Rp{{ number_format($totalBiaya, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Laba Bersih</td>
            <td>Rp{{ number_format($totalPendapatan - $totalModal - $totalBiaya, 0, ',', '.') }}</td>
        </tr>
    </table>

</body>
</html>
