@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-people-fill me-2"></i>Tambah Anggota</span>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-light btn-sm">
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

                    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            {{-- Kolom kiri --}}
                            <div class="col-md-7">
                                {{-- Pilih User --}}
                                <div class="mb-3">
                                    <label class="form-label">Pilih User</label>
                                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                        <option value="">-- Pilih user --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nama --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama"
                                           class="form-control @error('nama') is-invalid @enderror"
                                           value="{{ old('nama') }}" placeholder="Nama lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" rows="2"
                                              class="form-control @error('alamat') is-invalid @enderror"
                                              placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- No HP --}}
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input type="text" name="no_hp"
                                           class="form-control @error('no_hp') is-invalid @enderror"
                                           value="{{ old('no_hp') }}" placeholder="08xxxx">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="email@contoh.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Kolom kanan --}}
                            <div class="col-md-5">
                                {{-- Foto --}}
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" id="foto"
                                           class="form-control @error('foto') is-invalid @enderror"
                                           accept="image/*">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <img id="fotoPreview"
                                         style="display:none; max-width:150px; margin-top:10px;"
                                         class="img-thumbnail">
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="aktif" {{ old('status') === 'nonaktif' ? '' : 'selected' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary px-4 me-2">Simpan</button>
                            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('foto').addEventListener('change', function () {
    const [file] = this.files;
    if (!file) return;
    const img = document.getElementById('fotoPreview');
    img.src = URL.createObjectURL(file);
    img.style.display = 'block';
});
</script>
@endsection
