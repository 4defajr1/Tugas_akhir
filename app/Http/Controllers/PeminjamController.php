<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\detailPeminjam;
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
    $query = Peminjam::with(['anggota', 'detailPeminjam.buku']);
    if ($request->filled('anggota')) {
        $query->whereHas('anggota', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->anggota . '%');
        });
    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('tanggal_awal')) {
    $query->whereDate('tanggal_pinjam', '>=', $request->tanggal_awal);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('tanggal_pinjam', '<=', $request->tanggal_akhir);
    }

    $peminjam = $query->orderBy('tanggal_pinjam', 'desc')->get();
    return view('peminjam.index', compact('peminjam'));

    if ($request->filled('buku')) {
        $query->whereHas('detailPeminjam.buku', function ($q) use ($request) {
            $q->where('judul_buku', 'like', '%' . $request->buku . '%');
        });
    }

}

    public function create()
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('peminjam.create', compact('buku', 'anggota'));
    }
    //peminjaman by buku
//     public function createSingle(Buku $buku){
//         $anggota = Auth::user()->anggota;

//         if (! $anggota) {
//             abort(403, 'Akun ini belum terhubung dengan data anggota.');
//         }
//         return view('peminjam.create_single', compact('buku', 'anggota'));
//         }
        
// //batasan peminjaman
//     public function storeSingle(Request $request, Buku $buku)
//     {
//         $anggotaId = $request->anggota_id; // atau dari Auth/user->anggota_id

//         // hitung total buku yang masih dipinjam anggota ini
//         $totalSedangDipinjam = DetailPeminjam::whereHas('peminjam', function ($q) use ($anggotaId) {
//                 $q->where('anggota_id', $anggotaId)
//                 ->where('status', 'dipinjam');
//             })
//             ->whereNull('tanggal_kembali')
//             ->count();

//         if ($totalSedangDipinjam >= 3) {
//             return back()->withErrors('Maksimal 3 buku yang boleh dipinjam sekaligus.')->withInput();
//         }
        
//         $request->validate([
//             'anggota_id'         => 'required|exists:anggota,id',
//             'tanggal_pinjam'     => 'required|date',
//             'tanggal_jatuh_tempo'=> 'required|date|after_or_equal:tanggal_pinjam',
//         ]);

//         DB::transaction(function () use ($request, $buku) {
//             $peminjam = Peminjam::create([
//                 'anggota_id'          => $request->anggota_id,
//                 'tanggal_pinjam'      => $request->tanggal_pinjam,
//                 'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
//                 'status'              => 'dipinjam',
//             ]);

//             DetailPeminjam::create([
//                 'peminjam_id'     => $peminjam->id,
//                 'buku_id'         => $buku->id,
//                 'tanggal_kembali' => null,
//                 'denda'           => 0,
//             ]);

//             // kurangi stok
//             $buku->decrement('stock', 1);
//         });

//         return redirect()->route('peminjam.index')->with('success', 'Buku berhasil dipinjam.');
//     }                       


    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'       => 'required|exists:anggota,id',
            'tanggal_pinjam'   => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'buku_id'          => 'required|array',
            'buku_id.*'        => 'exists:buku,id',
        ]);
//mencegah buku habis
        foreach ($request->buku_id as $bukuId) {
            $buku = Buku::find($bukuId);
            if ($buku->stock < 1) {
                return redirect()->back()->withErrors(['buku_id' => "Buku '{$buku->title}' tidak tersedia untuk dipinjam."])->withInput();
            }
        }
        DB::transaction (function () use ($request){
            $peminjam = Peminjam::create([
                'anggota_id'       => $request->anggota_id,
                'tanggal_pinjam'   => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status'           => 'dipinjam',
            ]);
            foreach ($request->buku_id as $bukuId) {
                detailpeminjam::create([
                    'peminjam_id'   => $peminjam->id,
                    'buku_id'       => $bukuId,
                    'tanggal_kembali' => null,
                    'denda'         => 0,
                ]);
    // mengurangi stok buku saat dipinjam
                Buku::where('id', $bukuId)->decrement('stock', 1);
            }
        });
        return redirect()->route('peminjam.index');
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
        return redirect()->route('peminjam.index')->with('success', 'Buku berhasil dipinjam.');
        
    }
}