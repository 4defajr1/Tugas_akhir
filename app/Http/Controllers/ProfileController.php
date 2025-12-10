<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjam;

class ProfileController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $anggota = $user->anggota;

        $peminjaman = Peminjam::with(['detailPeminjam.buku'])
                ->where('anggota_id', $anggota->id)
                ->orderByDesc('tanggal_pinjam')
                ->get();

            return view('profil.index', compact('user', 'anggota', 'peminjaman'));
        // return view('profil.index', compact('user', 'anggota'));
    }
}
