@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="card-title mb-0">{{ $user->name }}</h5>
                    <small class="text-muted">{{ $user->email }}</small>
                    <p class="mt-2 mb-0">
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    Profil Anggota
                </div>
                <div class="card-body">
                    @if($anggota)
                        <div class="mb-2"><strong>Nama:</strong> {{ $anggota->nama }}</div>
                        <div class="mb-2"><strong>NIM/NID:</strong> {{ $anggota->nim_nid }}</div>
                        <div class="mb-2"><strong>Alamat:</strong> {{ $anggota->alamat }}</div>
                        <div class="mb-2"><strong>No HP:</strong> {{ $anggota->no_hp }}</div>
                        <div class="mb-2"><strong>Status:</strong>
                            <span class="badge bg-{{ $anggota->status === 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($anggota->status) }}
                            </span>
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            Akun ini belum terdaftar sebagai anggota perpustakaan.
                            Silakan hubungi admin untuk didaftarkan.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
