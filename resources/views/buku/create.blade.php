@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-book-half me-2"></i>Buat Daftar Buku</span>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-light btn-sm">
                        Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                {{-- Judul --}}
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul_buku"
                                        class="form-control @error('judul_buku') is-invalid @enderror"
                                        value="{{ old('judul_buku') }}" placeholder="Masukkan judul buku">
                                    @error('judul_buku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Pengarang --}}
                                <div class="mb-3">
                                    <label class="form-label">Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control"
                                           value="{{ old('pengarang') }}" placeholder="Nama pengarang">
                                </div>

                                {{-- Penerbit --}}
                                <div class="mb-3">
                                    <label class="form-label">Penerbit</label>
                                    <input type="text" name="penerbit" class="form-control"
                                           value="{{ old('penerbit') }}" placeholder="Nama penerbit">
                                </div>

                                {{-- Tahun Terbit --}}
                                <div class="mb-3">
                                    <label class="form-label">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control"
                                           value="{{ old('tahun_terbit', date('Y')) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                {{-- Kategori --}}
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                       
                                    <select name="kategori_id" class="form-control">
                                        <option value="">Pilih kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- ISBN --}}
                                <div class="mb-3">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
                                </div>

                                {{-- Stock --}}
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="{{ old('stock', 1) }}">
                                </div>

                                {{-- Cover Buku --}}
                                <div class="mb-3">
                                    <label class="form-label">Cover Buku</label>
                                    <input type="file" name="cover" class="form-control">
                                    <div class="form-text">Format: jpg, png. Maks 2MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary px-4">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
