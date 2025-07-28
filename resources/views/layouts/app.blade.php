<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link href="app.css" rel="stylesheet"> <!-- Pastikan file ini ada -->
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto">
            <a href="/dashboard" class="mr-4">Dashboard</a>
            <a href="/produk" class="mr-4">Produk</a>
            <a href="/transaksi" class="mr-4">Transaksi</a>
            <a href="/laporan">Laporan</a>
        </div>
    </nav>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
