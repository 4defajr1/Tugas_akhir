@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<h1 class="mb-4">Tambah Anggota</h1>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih User</label>
        <select name="user_id" id="userSelect" class="form-select" required>
            <option value="">-- Pilih user --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                        data-nama="{{ $user->name }}"
                        data-email="{{ $user->email }}">
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" id="namaInput" class="form-control"
               value="{{ old('nama') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control"
               value="{{ old('alamat') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">No Hp</label>
        <input type="text" name="no_hp" class="form-control"
               value="{{ old('no_hp') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" id="emailInput" class="form-control"
               value="{{ old('email') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" name="status" class="form-control"
               value="{{ old('status', 'aktif') }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
</form>

<script>
document.getElementById('userSelect').addEventListener('change', function () {
    const option = this.options[this.selectedIndex];
    document.getElementById('namaInput').value  = option.dataset.nama  || '';
    document.getElementById('emailInput').value = option.dataset.email || '';
});
</script>
@endsection
