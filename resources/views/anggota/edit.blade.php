@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-pencil-square me-2"></i>Edit Anggota</span>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-dark btn-sm">
                        Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-7">
                                {{-- Nama --}}
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text"
                                           class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama"
                                           value="{{ old('nama', $anggota->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- User --}}
                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <select name="user_id"
                                            class="form-select @error('user_id') is-invalid @enderror"
                                            required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id', $anggota->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text"
                                           class="form-control @error('alamat') is-invalid @enderror"
                                           id="alamat" name="alamat"
                                           value="{{ old('alamat', $anggota->alamat) }}" required>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- No HP --}}
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text"
                                           class="form-control @error('no_hp') is-invalid @enderror"
                                           id="no_hp" name="no_hp"
                                           value="{{ old('no_hp', $anggota->no_hp) }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ old('email', $anggota->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status"
                                            class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="aktif" {{ old('status', $anggota->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $anggota->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-5">
                                {{-- Foto --}}
                                <div class="mb-3">
                                    <label class="form-label d-block">Foto</label>

                                    @if ($anggota->foto)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/'.$anggota->foto) }}"
                                                 class="rounded-circle border"
                                                 width="90" height="90"
                                                 alt="Foto sekarang">
                                        </div>
                                    @endif

                                    <input type="file" name="foto"
                                           class="form-control @error('foto') is-invalid @enderror"
                                           accept="image/*">
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary px-4 me-2">Update</button>
                            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
