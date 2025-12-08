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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div id="app">
       <nav class="navbar navbar-expand-md navbar-dark bg-dark bg-gradient shadow-sm">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-book-half me-2"></i>
            <span>PerpusFake</span>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Collapsible content --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            {{-- Left menu --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">About</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('buku*') ? 'active' : '' }}"
                           href="{{ route('buku.index') }}">List Buku</a>
                    </li>

                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori Buku</a></li>
                                <li><a class="dropdown-item" href="{{ route('anggota.index') }}">Daftar Anggota</a></li>
                                <li><a class="dropdown-item" href="{{ route('peminjam.index') }}">Daftar Peminjam</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Right menu (auth) --}}
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.index') }}">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</html>
