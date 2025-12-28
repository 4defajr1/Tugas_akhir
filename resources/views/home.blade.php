@extends('layouts.app')

@section('content')
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
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
            @endauth
        </div>
        <div class="col-md-6 text-center">
            <img src="https://via.placeholder.com/420x260?text=Perpustakaan"
                 class="img-fluid rounded shadow-sm" alt="Perpustakaan">
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
@endsection
