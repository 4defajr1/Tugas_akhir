@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<h1>Daftar Kategori</h1>

<a href="{{route('kategori.create')}}" class="btn btn-primary">Tambah Kategori</a>
{{-- <table class="table table-striped mt-3"> --}}
    <table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategoris as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nama_kategori }}</td>
                <td>{{ $row->deskripsi }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', $row->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
