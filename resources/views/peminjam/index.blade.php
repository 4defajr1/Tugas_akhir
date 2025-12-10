@extends('layouts.app')


@section('content')
    
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Nama anggota</label>
                <input type="text" name="anggota" class="form-control" value="{{ request('anggota') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua status --</option>
                    <option value="dipinjam" {{ request('status')=='dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="kembali" {{ request('status')=='kembali' ? 'selected' : '' }}>Kembali</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Tgl mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Tgl akhir</label>
                <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
            </div>
            <div class="col-md-3 text-md-start text-center">
                <button type="submit" class="btn btn-primary me-1 mt-2">Filter</button>
                <a href="{{ route('peminjam.index') }}" class="btn btn-secondary mt-2">Reset</a>
            </div>
        </form>
    </div>
</div>
<table class="table table-striped table-hover align-middle">
    <thead class="table-light">
        <tr class="text-center">
            <th style="width: 40px;">ID</th>
            <th>Anggota</th>
            <th style="width: 120px;">Tgl Pinjam</th>
            <th style="width: 130px;">Jatuh Tempo</th>
            <th style="width: 110px;">Status</th>
            <th>Buku</th>
            <th style="width: 130px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($detailPeminjam as $row)
    <tr>
        <td class="text-center">{{ $row->id }}</td>
        <td class="text-center">{{ $row->peminjam->anggota->nama ?? '-' }}</td>
        <td class="text-center">{{ $row->peminjam->tanggal_pinjam ?? '' }}</td>
        <td class="text-center">{{ $row->peminjam->tanggal_jatuh_tempo ?? '' }}</td>
        <td class="text-center">
            @php
                $statusClass = $row->peminjam->status === 'dipinjam' ? 'warning' : 'success';
            @endphp
            <span class="badge bg-{{ $statusClass }}">
                {{ ucfirst($row->peminjam->status ?? '') }}
            </span>
        </td>
        <td>
            <div class="small">
                {{ $row->buku->judul_buku ?? '-' }}
            </div>
        </td>
        <td class="text-center">
            @if(($row->peminjam->status ?? '') === 'dipinjam')
                <a href="{{ route('peminjam.return.form', $row->peminjam_id) }}"
                   class="btn btn-success btn-sm">
                    Pengembalian
                </a>
            @else
                <span class="text-muted small">Selesai</span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">Belum ada data.</td>
    </tr>
@endforelse
    </tbody>
</table>
</div>
@endsection
