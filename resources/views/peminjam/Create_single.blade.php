{{-- {{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pinjam Buku: {{ $buku->judul_buku }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjam.store.single', $buku->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Anggota</label>
            <select name="anggota_id" class="form-select" required>
                @if($anggota)
                    <option value="{{ $anggota->id }}" selected>
                        {{ $anggota->nama }}
                    </option>
                @else
                    {{-- kalau mau pilih manual, ganti jadi loop semua anggota --}}
                {{-- @endif
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control"
                   value="{{ old('tanggal_pinjam', now()->toDateString()) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control"
                   value="{{ old('tanggal_jatuh_tempo') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Pinjam Buku Ini</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection --}} 

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Form Peminjaman Single</h1>
    <p>Buku: <strong>{{ $buku->judul_buku ?? '-' }}</strong></p>
    <p>Anggota: <strong>{{ $anggota->nama ?? '-' }}</strong></p>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjam.store.single', $buku->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control"
                   value="{{ old('tanggal_pinjam', now()->toDateString()) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control"
                   value="{{ old('tanggal_jatuh_tempo') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Pinjam Buku Ini</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Form Peminjaman Single</h1>
    <p>Buku: <strong>{{ $buku->judul_buku ?? '-' }}</strong></p>
    <p>Anggota: <strong>{{ $anggota->nama ?? '-' }}</strong></p>
</div>
<form action="{{ route('peminjam.store.single', $buku->id) }}" method="POST">
    @csrf
    <!-- input tanggal dsb -->
    <button type="submit" class="btn btn-success">Pinjam Buku Ini</button>
</form>
@endsection --}}
