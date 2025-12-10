@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<h1>Data Anggota</h1>

<a href="{{route('anggota.create') }}" class="btn btn-primary">Tambah Anggota</a>
{{-- <table class="table table-bordered mt-3"> --}}
    <table class="table table-striped table-hover align-middle">
    {{-- <thead>
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
    </tbody> --}}
<thead>
<tr>
    <th>ID</th>
    <th>Foto</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No. Hp</th>
    <th>Email</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach ($anggota as $row)
<tr>
    <td>{{ $row->id }}</td>
    <td>
        <img src="{{ $row->foto ? asset('storage/'.$row->foto) : asset('images/default-user.png') }}"
             alt="{{ $row->nama }}"
             width="50">
    </td>
    <td>{{ $row->nama }}</td>
    <td>{{ $row->alamat }}</td>
    <td>{{ $row->no_hp }}</td>
    <td>{{ $row->email }}</td>
    <td>{{ $row->status }}</td>
    <td>
        <a href="{{ route('anggota.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('anggota.destroy', $row->id) }}"
              method="POST"
              style="display:inline-block"
              onsubmit="return confirm('Yakin hapus anggota ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>

</table>
@endsection