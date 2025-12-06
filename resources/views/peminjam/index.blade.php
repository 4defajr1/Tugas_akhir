@extends('layouts.app')

@section('content')
<h1>Data Peminjaman</h1>

<a href="{{ route('peminjam.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>
{{-- form filter --}}
<form method="GET" action="{{ route('peminjam.index') }}" class="row mb-3">
    <div class="col-md-3">
        <input type="text" name="anggota" class="form-control"
               placeholder="Nama anggota" value="{{ request('anggota') }}">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">-- Semua status --</option>
            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="kembali" {{ request('status') == 'kembali' ? 'selected' : '' }}>Kembali</option>
        </select>
    </div>
    <div class="col-md-3">
    <input type="date" name="tanggal_awal" class="form-control"
           value="{{ request('tanggal_awal') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="tanggal_akhir" class="form-control"
            value="{{ request('tanggal_akhir') }}">
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Reset</a>
    </div>
    <div class="col-md-3">
        <input type="text" name="buku" class="form-control"
            placeholder="Judul buku" value="{{ request('buku') }}">
    </div>
</form>


{{-- <table class="table table-bordered"> --}}
    <table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Anggota</th>
            <th>Tgl Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
            <th>Buku</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($peminjam as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->anggota->nama ?? '-' }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_jatuh_tempo }}</td>
            <td>{{ $p->status }}</td>
            <td>
                
                @foreach ($p->detailPeminjam ?? [] as $d)
                    {{ $d->buku->judul_buku ?? '???' }}<br>
                @endforeach
                <td>
                 <a href="{{ route('peminjam.return.form', $p->id) }}" class="btn btn-success btn-sm">Pengembalian</a>   
                </td>
                
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
