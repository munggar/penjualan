<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Toko Jahit</title>

    <!-- Font & Bootstrap -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Penjualan - Toko Aksesoris Jahit</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    @php use Carbon\Carbon; @endphp
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background: linear-gradient(to right, #6a11cb, #2575fc);
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

        table th,
        table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <header>
        <nav class="navbar navbar-dark" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-bold" href="#">Toko Aksesoris Jahit</a>

                <!-- Hamburger Button -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNav" aria-controls="mobileNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Offcanvas Top Menu (tidak full tinggi) -->
            <div class="offcanvas offcanvas-top text-bg-dark" tabindex="-1" id="mobileNav"
                aria-labelledby="mobileNavLabel" style="height: 60vh;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="mobileNavLabel">Menu Navigasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/produk">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/transaksi">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/laporan">Laporan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
