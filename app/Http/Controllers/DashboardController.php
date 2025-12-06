<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;
use App\Models\Anggota;
use App\Models\Peminjam;
use App\Models\DetailPeminjam;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $totalBuku        = Buku::count();
        $totalAnggota     = Anggota::count();
        $peminjamanAktif  = Peminjam::where('status', 'dipinjam')->count();
        $totalDendaHariIni = DetailPeminjam::whereDate('tanggal_kembali', Carbon::today())->sum('denda');

        $peminjamanTerbaru = Peminjam::with(['anggota', 'detailPeminjam.buku'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'peminjamanAktif',
            'totalDendaHariIni',
            'peminjamanTerbaru'
        ));
    }
}
