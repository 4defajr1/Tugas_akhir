@extends('layouts.app')

@section('title', 'buat daftar buku')

@section('content')
    <h1>Buat Daftar Buku</h1>

    {{-- <form action="{{ route('buku.store') }}" method="POST"> --}}
    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-1"> 
            <label for="judul_buku">Judul:</label><br>
            <input type="text" id="judul" name="judul" required>
        </div>

        <div class="mb-1">
            <label for="pengarang">Pengarang:</label><br>
            <input type="text" id="pengarang" name="pengarang" required>
        </div>
        
        <div class="mb-1">
            <label for="penerbit">Penerbit:</label><br>
            <input type="text" id="penerbit" name="penerbit" required>
        </div>
        
        <div class="mb-1">
            <label for="tahun_terbit">Tahun Terbit:</label><br>
            <input type="number" id="tahun_terbit" name="tahun_terbit" required>
        </div>
        
        <div class="mb-1">
            <label for="kategori_id">Kategori:</label><br>
            <select id="kategori_id" name="kategori_id" required>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-1">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>
        </div>
        <div class="mb-1">
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku</label>
            <input type="file" name="cover" id="cover" class="form-control">
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
