@extends('layouts.app')

@section('content')
<h1>Transaksi Peminjaman</h1>

<form action="{{ route('peminjam.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Anggota</label>
        <select name="anggota_id" class="form-control" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach ($anggota as $a)
                <option value="{{ $a->id }}">{{ $a->nama }} ({{ $a->nim_nid }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control"
               value="{{ date('Y-m-d') }}">
    </div>

    <div class="mb-3">
        <label>Tanggal Jatuh Tempo</label>
        <input type="date" name="tanggal_jatuh_tempo" class="form-control">
    </div>

    <div class="mb-3">
        <label>Pilih Buku (bisa lebih dari satu)</label>
        <select name="buku_id[]" class="form-control" multiple size="5" required>
            @foreach ($buku as $b)
                <option value="{{ $b->id }}">
                    {{ $b->judul_buku }} (stok: {{ $b->stok }})
                </option>
            @endforeach
        </select>
        <small>Tahan Ctrl (Windows) / Cmd (Mac) untuk pilih lebih dari satu.</small>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
</form>
@endsection
