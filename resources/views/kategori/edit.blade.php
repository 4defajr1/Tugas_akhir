@extends('layouts.app')

@section('content')
<h1>Edit Kategori</h1>

<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ old('deskripsi', $kategori->deskripsi) }}</textarea><br><br>

    <button type="submit">Update</button>
</form>
@endsection
