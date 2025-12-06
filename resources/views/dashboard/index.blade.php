@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Perpustakaan</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Buku</h5>
                    <p class="card-text fs-3">{{ $totalBuku }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Anggota</h5>
                    <p class="card-text fs-3">{{ $totalAnggota }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman Aktif</h5>
                    <p class="card-text fs-3">{{ $peminjamanAktif }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Denda Hari Ini</h5>
                    <p class="card-text fs-3">Rp {{ number_format($totalDendaHariIni, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Peminjaman Terbaru</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamanTerbaru as $p)
                <tr>
                    <td>{{ $p->anggota->nama ?? '-' }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>
                        <span class="badge bg-{{ $p->status == 'dipinjam' ? 'warning' : 'success' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>
                        @foreach (($p->detailPeminjam ?? []) as $d)
                            {{ $d->buku->judul_buku ?? '???' }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
