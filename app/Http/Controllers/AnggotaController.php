<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        // User yang belum punya relasi anggota
        $users = User::doesntHave('anggota')
            ->orderBy('name')
            ->get();

        return view('anggota.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:anggota,user_id',
            'nama'    => 'required',
            'alamat'  => 'required',
            'no_hp'   => 'required',
            'email'   => 'required|email',
            'status'  => 'required',
        ]);

        Anggota::create([
            'user_id' => $request->user_id,
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'email'   => $request->email,
            'status'  => $request->status,
        ]);

        return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        $users = User::doesntHave('anggota')
            ->orWhere('id', $anggota->user_id)
            ->orderBy('name')
            ->get();

        return view('anggota.edit', compact('anggota', 'users'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id|unique:anggota,user_id,' . $id,
            'nama'    => 'required',
            'alamat'  => 'required',
            'no_hp'   => 'required',
            'email'   => 'required|email',
            'status'  => 'required',
        ]);

        $anggota->update([
            'user_id' => $request->user_id,
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'email'   => $request->email,
            'status'  => $request->status,
        ]);

        return redirect()->route('anggota.index');
    }

        public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Cek apakah masih punya data peminjaman
        if ($anggota->peminjam()->exists()) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Tidak bisa menghapus anggota yang masih punya data peminjaman.');
        }

        // Jika aman, hapus
        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}