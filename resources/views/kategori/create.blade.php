@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('content')
<h1>Tambah Kategori</h1>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
