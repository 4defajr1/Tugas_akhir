{{-- @extends('layout.app')

@section('content')
<h1>Pengembalian Buku</h1>

<form action="{{ route('peminjam.processreturn', $peminjam->id) }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Pilih</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjam->detail_peminjam ?? [] as $detail)
            <tr>
                <td>
                    <input type="checkbox" name="detail_id[]" value="{{ $detail->id }}">
                </td>
                <td>{{ $detail->buku->judul }}</td>
                <td>{{ $detail->tanggal_pinjam }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<h1>Form Pengembalian</h1>

<form action="{{ route('peminjam.processreturn', $peminjam->id) }}" method="POST">
    @csrf

    <p>Anggota: {{ $peminjam->anggota->nama ?? '-' }}</p>
    <p>Tanggal Jatuh Tempo: {{ $peminjam->tanggal_jatuh_tempo }}</p>

    <h4>Pilih buku yang dikembalikan:</h4>

    @foreach (($peminjam->detailPeminjam ?? []) as $detail)
        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   name="detail_id[]"
                   value="{{ $detail->id }}">
            <label class="form-check-label">
                {{ $detail->buku->judul_buku ?? 'Tanpa judul' }}
            </label>
        </div>
    @endforeach

    <button type="submit" class="btn btn-success mt-3">Proses Pengembalian</button>
</form>
@endsection

