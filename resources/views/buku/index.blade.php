@extends('layouts.app')

@section('title', 'daftar buku')

@section('content')
<h1>Daftar Buku</h1>
<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3"> tambah Buku</a>
{{-- <table class="table table-bordered"> --}}
    <table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>penerbit</th>
            <th>Tahun Terbit</th>
            <th>ISBN</th>
            <th>Stok</th>
            <th>Kategori_ID</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($buku as $b)
        <tr>
            <td>{{ $b->id }}</td>
            <td>{{ $b->judul_buku }}</td>
            <td>{{ $b->pengarang }}</td>
            <td>{{ $b->penerbit }}</td>
            <td>{{ $b->tahun_terbit }}</td>
            <td>{{ $b->isbn }}</td>
            <td>{{ $b->stock }}</td>
            <td>{{ $b->kategori_id }}</td>
            {{-- <td>
                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                </form>
            </td> --}}
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i>
                        
                    </a>
                    <form action="{{ route('buku.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>

                        </button>
                    </form>
                    <a href="{{ route('peminjam.create.single', $b->id) }}" class="btn btn-success">
                    <i class="bi bi-book"></i> 
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection