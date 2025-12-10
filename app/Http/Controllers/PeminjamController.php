<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\buku as ModelsBuku;
use App\Models\DetailPeminjam;
use App\Models\DetailPeminjam as ModelsDetailPeminjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PeminjamController extends Controller
{
    // public function index()
    // {
    //     $peminjam = Peminjam::all();
    //     return view('peminjam.index', compact('peminjam'));
        
    // }

//filter data
    public function index(Request $request)
    {
        $query = DetailPeminjam::with(['peminjam.anggota', 'buku']);

        if ($request->filled('anggota')) {
            $query->whereHas('peminjam.anggota', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->anggota . '%');
            });
        }

        if ($request->filled('status')) {
            $query->whereHas('peminjam', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        if ($request->filled('tanggal_awal')) {
            $query->whereHas('peminjam', function ($q) use ($request) {
                $q->whereDate('tanggal_pinjam', '>=', $request->tanggal_awal);
            });
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereHas('peminjam', function ($q) use ($request) {
                $q->whereDate('tanggal_pinjam', '<=', $request->tanggal_akhir);
            });
        }

        $detailPeminjam = $query->latest()->get();

        return view('peminjam.index', compact('detailPeminjam'));
    }

    public function create()
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('peminjam.create', compact('buku', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'           => 'required|exists:anggota,id',
            'tanggal_pinjam'       => 'required|date',
            'tanggal_jatuh_tempo'  => 'required|date',
            'buku_id'              => 'required|array',
            'buku_id.*'            => 'exists:buku,id',
        ]);

        DB::transaction(function () use ($request) {
            // buat data peminjam utama
            $peminjam = Peminjam::create([
                'anggota_id'          => $request->anggota_id,
                'tanggal_pinjam'      => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status'              => 'dipinjam',
            ]);

            // looping setiap buku yang dipinjam
            foreach ($request->buku_id as $bukuId) {
                // optional: cek stok dulu
                $buku = Buku::findOrFail($bukuId);
                if ($buku->stock < 1) {
                    throw new \Exception("Stok buku habis");
                }

                DetailPeminjam::create([
                    'peminjam_id'      => $peminjam->id,
                    'buku_id'          => $bukuId,
                    'tanggal_kembali'  => null,
                    'denda'            => 0,
                ]);

                // kurangi stok buku
                Buku::where('id', $bukuId)->decrement('stock', 1);
            }
        });

        return redirect()->route('peminjam.index')->with('success', 'Peminjaman berhasil disimpan.');
    }
    public function showreturnform($id)
    {
        $peminjam = Peminjam::with('anggota', 'detailPeminjam.buku')->findOrFail($id);
        return view('peminjam.return', compact('peminjam'));
    }
    public function processreturn(Request $request, $id)
    {
        $peminjam = Peminjam::with('detailPeminjam')->findOrFail($id);
        $request->validate([
            'detail_id' => 'required|array',
            'detail_id.*' => 'exists:detail_peminjam,id',
        ]);

        $today = Carbon::today();

        foreach ($peminjam->detailPeminjam as $detail) {
            if (in_array($detail->id, $request->detail_id)) {
                $denda = 0;
                if (Carbon::parse($today)->gt(Carbon::parse($peminjam->tanggal_jatuh_tempo))) {
                    $selisih = Carbon::parse($peminjam->tanggal_jatuh_tempo)->diffInDays($today);
                    $denda = $selisih * 2000;
                }
                $detail->update([
                    'tanggal_kembali' => $today,
                    'denda'           => $denda,
                ]);
    // update stok buku (pengembalian stok buku)
                $detail->buku->increment('stock', 1);
            }
        }
    // update status peminjaman jika semua buku telah dikembalikan
        $semuaKembali = $peminjam->detailPeminjam()->whereNull('tanggal_kembali')->count() === 0;
        if ($semuaKembali) {
            $peminjam->update(['status' => 'kembali']);
        }
        return redirect()->route('peminjam.index');
    }

    public function createSingle(Buku $buku)
    {
        $anggota = Auth::user()->anggota;
        if (! $anggota) {
            abort(403, 'Akun ini belum terhubung dengan data anggota, Silahkan Hubungi Admin');
        }

        return view('peminjam.create_single', compact('buku', 'anggota'));
    }

    public function storeSingle(Request $request, Buku $buku)
    {
        $request->validate([
            'tanggal_pinjam'      => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        $anggota = Auth::user()->anggota;   // relasi user -> anggota
        if (!$anggota) {
            abort(403, 'Akun ini belum terhubung dengan data anggota.');
        }

        DB::transaction(function () use ($request, $buku, $anggota) {
            $peminjam = Peminjam::create([
                'anggota_id'          => $anggota->id,
                'tanggal_pinjam'      => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status'              => 'dipinjam',
            ]);

            detailPeminjam::create([
                'peminjam_id'     => $peminjam->id,
                'buku_id'         => $buku->id,
                'tanggal_kembali' => null,
                'denda'           => 0,
            ]);

            if ($buku->stock < 1) {
                throw new \Exception('Stok buku habis');
            }
            $buku->decrement('stock', 1);
        });

        // setelah berhasil, kembali ke profil user
        return redirect()->route('profil.index')->with('success', 'Buku berhasil dipinjam.');

        // return redirect()->route('peminjam.index')->with('success', 'Buku berhasil dipinjam.');
        
    }
    
}