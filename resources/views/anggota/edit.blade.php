@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('content')
<h1>Edit Anggota</h1>
<form action="{{ route('anggota.update', $anggota->id) }}" method="POST"enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota->nama }}" required>
    </div>
{{--foto--}}
    <div class="mb-3">
        <label class="form-label d-block">Foto</label>

        @if ($anggota->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/anggota/'.$anggota->foto) }}"
                    class="rounded-circle border" width="80" height="80" alt="Foto sekarang">
            </div>
        @endif

        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
    <label class="form-label">User</label>
    <select name="user_id" class="form-select" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}"
                {{ $anggota->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $anggota->alamat }}" required>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No Hp</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $anggota->no_hp }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $anggota->email }}" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control" id="status" name="status" value="{{ $anggota->status }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection