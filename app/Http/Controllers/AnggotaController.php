<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Tampilkan daftar anggota
    public function index()
    {
        $anggota = Anggota::with('user')->orderBy('id')->get();
        return view('anggota.index', compact('anggota'));
    }

    // Form tambah anggota
    public function create()
    {
        $users = User::doesntHave('anggota')
            ->orderBy('name')
            ->get();

        return view('anggota.create', compact('users'));
    }

    // Simpan anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:anggota,user_id',
            'nama'    => 'required',
            'nim_nid' => 'nullable',
            'alamat'  => 'required',
            'no_hp'   => 'required',
            'email'   => 'required|email',
            'status'  => 'required',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'user_id',
            'nama',
            'nim_nid',
            'alamat',
            'no_hp',
            'email',
            'status',
        ]);

        if ($request->hasFile('foto')) {
            // simpan ke storage/app/public/anggota
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Form edit anggota
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        $users = User::doesntHave('anggota')
            ->orWhere('id', $anggota->user_id)
            ->orderBy('name')
            ->get();

        return view('anggota.edit', compact('anggota', 'users'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id|unique:anggota,user_id,' . $id,
            'nama'    => 'required',
            'nim_nid' => 'nullable',
            'alamat'  => 'required',
            'no_hp'   => 'required',
            'email'   => 'required|email',
            'status'  => 'required',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'user_id',
            'nama',
            'nim_nid',
            'alamat',
            'no_hp',
            'email',
            'status',
            'foto'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/anggota', $namaFile);
            $data['foto'] = 'anggota/' . $namaFile;
        }

        $anggota->update($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Blokir jika masih punya peminjaman
        if ($anggota->peminjam()->exists()) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Tidak bisa menghapus anggota yang masih punya data peminjaman.');
        }

        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
