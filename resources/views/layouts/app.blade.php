<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PerpusFake') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'PerpusFake') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            {{-- layout lama --}}
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://127.0.0.1:8000/dashboard">Perpusfake</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/home">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/about">About</a>
                    </li>
                    <li><a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/buku">List Buku</a></li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="http://127.0.0.1:8000/kategori">Kategori Buku</a></li>
                        <li><a class="dropdown-item" href="http://127.0.0.1:8000/anggota">Daftar Anggota</a></li>
                        <li><a class="dropdown-item" href="http://127.0.0.1:8000/peminjam">Daftar Peminjam</a></li>
                        <li><a class="dropdown-item" href="http://127.0.0.1:8000/dashboard">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                    </ul>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>
            
                    </ul>
                    

                    <li class="nav-item">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
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
        

        <main class="py-4">
            <div class="container">
             @yield('content')   
            </div>
            
        </main>
    </div>
<div class="container py-5">

    {{-- Hero --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold mb-3">Sistem Perpustakaan Digital</h1>
            <p class="fs-5 text-muted">
                Kelola data buku, anggota, dan peminjaman dengan cepat dan rapi,
                khusus untuk kebutuhan kampus/sekolah Anda.
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-2">Buka Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login Admin</a>
            @endauth
        </div>
        <div class="col-md-6 text-center">
            <img src="https://via.placeholder.com/420x260?text=Perpustakaan" class="img-fluid rounded shadow-sm" alt="Perpustakaan">
        </div>
    </div>

    {{-- Fitur utama --}}
    <div class="row text-center mb-5">
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Buku</h5>
                    <p class="card-text text-muted">Tambah, edit, dan kelola koleksi buku lengkap dengan kategori.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Data Anggota</h5>
                    <p class="card-text text-muted">Pantau anggota aktif dan riwayat peminjaman mereka.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Transaksi Cepat</h5>
                    <p class="card-text text-muted">Pencatatan peminjaman–pengembalian dan denda otomatis.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dashboard Statistik</h5>
                    <p class="card-text text-muted">Lihat ringkasan jumlah buku, anggota, dan peminjaman aktif.</p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
