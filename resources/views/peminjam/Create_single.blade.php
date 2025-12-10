@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-arrow-down me-2"></i>Form Peminjaman</span>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-light btn-sm">
                        Kembali
                    </a>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <small class="text-muted d-block">Buku</small>
                        <span class="fw-semibold">{{ $buku->judul_buku ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <small class="text-muted d-block">Anggota</small>
                        <span class="fw-semibold">{{ $anggota->nama ?? '-' }}</span>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('peminjam.store.single', $buku->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                   class="form-control"
                                   value="{{ now()->toDateString() }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Jatuh Tempo</label>
                            <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo"
                                   class="form-control">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="submit" class="btn btn-success px-4">
                                Pinjam Buku Ini
                            </button>
                            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary px-4">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tglPinjam = document.getElementById('tanggal_pinjam');
    const tglJatuhTempo = document.getElementById('tanggal_jatuh_tempo');

    function updateJatuhTempo() {
        if (!tglPinjam.value) return;

        const date = new Date(tglPinjam.value);
        date.setDate(date.getDate() + 3);

        const year  = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day   = String(date.getDate()).padStart(2, '0');

        tglJatuhTempo.value = `${year}-${month}-${day}`;
    }

    updateJatuhTempo();
    tglPinjam.addEventListener('change', updateJatuhTempo);
});
</script>
@endsection
