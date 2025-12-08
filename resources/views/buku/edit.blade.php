@extends('layouts.app')

@section('title', 'edit buku')
@section('content')
<h1>Edit Buku</h1>
{{-- <from action="{{ route('buku.update', $buku->id) }}" method="POST"> --}}
<form action="{{ route('buku.update', $buku->id) }}" method="PUT" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
    </div>
    <div class="mb-3">
        <label for="pengarang" class="form-label">Pengarang</label>
        <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}" required>
    </div>
    <div class="mb-3">
        <label for="penerbit" class="form-label">Penerbit</label>
        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" required>
    </div>
    <div class="mb-3">
        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" required>
    </div>
    <div class="mb-3">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $buku->isbn }}" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="{{ $buku->stok }}" required>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select class="form-select" id="kategori_id" name="kategori_id" required>
            @foreach($kategori as $k)
            <option value="{{ $k->id }}" {{ $buku->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="cover" class="form-label">Cover Buku</label>
        <input type="file" name="cover" id="cover" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update Buku</button>
</from>
@endsection