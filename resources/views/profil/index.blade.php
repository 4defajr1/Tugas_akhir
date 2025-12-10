@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row">
        {{-- Kartu profil user + foto --}}
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <div class="mb-3">
                        <img src="{{ $anggota && $anggota->foto
                                    ? asset('storage/'.$anggota->foto)
                                    : asset('storage/anggota/default-user.png') }}"
                             class="rounded-circle border" width="96" height="96" alt="Foto profil">
                    </div>

                    <h5 class="card-title mb-0">{{ $anggota->nama ?? $user->name }}</h5>
                    <small class="text-muted d-block mb-2">{{ $user->email }}</small>

                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} me-1">
                        {{ ucfirst($user->role) }}
                    </span>
                    @if($anggota)
                        <span class="badge bg-{{ $anggota->status === 'aktif' ? 'success' : 'secondary' }}">
                            {{ ucfirst($anggota->status) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Detail anggota + riwayat peminjaman --}}
        <div class="col-md-8 mb-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header">
                    Profil Anggota
                </div>
                <div class="card-body">
                    @if($anggota)
                        <div class="mb-2"><strong>Nama:</strong> {{ $anggota->nama }}</div>
                        <div class="mb-2"><strong>NIM/NID:</strong> {{ $anggota->nim_nid }}</div>
                        <div class="mb-2"><strong>Alamat:</strong> {{ $anggota->alamat }}</div>
                        <div class="mb-2"><strong>No HP:</strong> {{ $anggota->no_hp }}</div>
                    @else
                        <p class="text-muted mb-0">
                            Akun ini belum terdaftar sebagai anggota perpustakaan.
                            Silakan hubungi admin untuk didaftarkan.
                        </p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Riwayat Peminjaman</span>
                    @if($anggota)
                        <span class="badge bg-secondary">
                            Total: {{ $peminjaman->count() }} peminjaman
                        </span>
                    @endif
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 120px;">Tgl Pinjam</th>
                                <th style="width: 120px;">Jatuh Tempo</th>
                                <th>Buku</th>
                                <th style="width: 90px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $row)
                                <tr>
                                    <td>{{ $row->tanggal_pinjam }}</td>
                                    <td>{{ $row->tanggal_jatuh_tempo }}</td>
                                    <td>
                                        @foreach ($row->detailPeminjam as $detail)
                                            <div>{{ $detail->buku->judul_buku ?? '-' }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $row->status === 'dipinjam' ? 'warning' : 'success' }}">
                                            {{ ucfirst($row->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        Belum ada peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
