@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<h1>Data Anggota</h1>

<a href="{{route('anggota.create') }}" class="btn btn-primary">Tambah Anggota</a>
{{-- <table class="table table-bordered mt-3"> --}}
    <table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No_Hp</th>
            <th>Email</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($anggota as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->alamat }}</td>
            <td>{{ $a->no_hp }}</td>
            <td>{{ $a->email }}</td>
            <td>{{ $a->status }}</td>
            <td>
                <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection