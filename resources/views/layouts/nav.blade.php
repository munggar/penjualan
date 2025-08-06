<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Aksesoris Jahit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="d-flex min-vh-100 bg-body-secondary">

    <!-- Sidebar (Desktop only) -->
    <aside class="d-none d-md-block bg-dark text-white p-4 position-fixed"
        style="width: 190px; height: 100vh; z-index: 1000;">
        <h4 class="mb-4">Toko Aksesoris Jahit</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/" class="nav-link text-white">Beranda</a></li>
            <li class="nav-item"><a href="/produk" class="nav-link text-white">Produk</a></li>
            <li class="nav-item"><a href="/transaksi" class="nav-link text-white">Transaksi</a></li>
            <li class="nav-item"><a href="/laporan" class="nav-link text-white">Laporan</a></li>
            <li class="nav-item"><a href="/cost" class="nav-link text-white">Biaya</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-absolute" style="width: 100%;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Toko
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                href="#" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                    alt="avatar" width="32" height="32" class="rounded-circle">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <div class="dropdown-item-text text-muted small">
                                    {{ Auth::user()->email }}
                                </div>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Navbar (Mobile only) -->
        <nav class="navbar navbar-dark bg-primary d-md-none position-absolute" style="width: 100%;z-index: 1000;">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold">Toko Aksesoris Jahit</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <!-- Offcanvas Menu for Mobile -->
        <div class="offcanvas offcanvas-top text-bg-dark d-md-none" tabindex="-1" id="mobileMenu" style="height: 60vh;">
            <div class="offcanvas-header text-white py-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Halo, {{ Auth::user()->name }} 👋</h6>
                    <small>Selamat datang kembali!</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>


            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="/" class="nav-link text-white">Beranda</a></li>
                    <li class="nav-item"><a href="/produk" class="nav-link text-white">Produk</a></li>
                    <li class="nav-item"><a href="/transaksi" class="nav-link text-white">Transaksi</a></li>
                    <li class="nav-item"><a href="/laporan" class="nav-link text-white">Laporan</a></li>
                    <li class="nav-item"><a href="/cost" class="nav-link text-white">Biaya</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link text-white">Logout</a></li>
                </ul>
            </div>
        </div>

        {{-- <main class="py-4"> --}}
        @yield('content')
        {{-- </main> --}}

    </div>
</body>

</html>
