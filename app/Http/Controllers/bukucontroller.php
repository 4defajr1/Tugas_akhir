<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;



class bukucontroller extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku'));
    }
    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'    => 'required',
            'pengarang'     => 'required',
            'tahun_terbit'  => 'required|integer',
            'kategori_id'   => 'required|exists:kategori,id',
            'isbn'          => 'required|unique:buku,isbn',
            'stock'         => 'required|integer',
        ]);
        Buku::create($request->all());
        return redirect()->route('buku.index');
    }
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku'    => 'required',
            'pengarang'     => 'required',
            'tahun_terbit'  => 'required|integer',
            'kategori_id'   => 'required|exists:kategori,id',
            'isbn'          => 'required|unique:buku,isbn,' . $id,
            'stock'         => 'required|integer',
        ]);
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return redirect()->route('buku.index');
    }
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index');
    }
}