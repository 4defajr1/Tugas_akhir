@extends('layouts.app')

@section('title', 'daftar buku')

@section('content')
<h1>Daftar Buku</h1>
<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3"> tambah Buku</a>
{{-- <table class="table table-bordered"> --}}
  <form method="GET" action="{{ route('buku.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control"
               placeholder="Cari judul/pengarang/ISBN"
               value="{{ request('q') }}">
    </div>
    
    <div class="col-md-3">
        <select name="kategori_id" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}"
                    {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
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
                    {{-- <a href="{{ route('peminjam.create.single', $b->id) }}" class="btn btn-success">
                    <i class="bi bi-book"></i>  --}}
                    </button> 
                    </a>
                    <button type="button"
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#detailBukuModal{{ $b->id }}">
                            lihat
                    </button> 
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@foreach ($buku as $b)
<div class="modal fade" id="detailBukuModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $b->judul_buku }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center mb-3">
            <img src="{{ $b->cover ? asset('storage/'.$b->cover) : 'https://via.placeholder.com/200x280?text=Cover' }}"
                 class="img-fluid rounded shadow-sm" alt="Cover {{ $b->judul_buku }}">
          </div>
          <div class="col-md-8">
            <p><strong>Pengarang:</strong> {{ $b->pengarang }}</p>
            <p><strong>Penerbit:</strong> {{ $b->penerbit }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $b->tahun_terbit }}</p>
            <p><strong>Stok:</strong> {{ $b->stock }}</p>
            <hr>
            <p class="mb-0">
                {{ Str::limit($b->sinopsis ?? 'Belum ada sinopsis.', 250) }}
            </p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a href="{{ route('peminjam.create.single', $b->id) }}" class="btn btn-success btn-sm">
            Pinjam Buku Ini
        </a>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection