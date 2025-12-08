<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;



class bukucontroller extends Controller
{
    // public function index()
    // {
    //     $buku = Buku::with('kategori')->get();
    //     return view('buku.index', compact('buku'));
    // }
public function index(Request $request)
{
    $query = Buku::with('kategori');

    if ($request->filled('q')) {
        $q = $request->q;
        $query->where(function ($sub) use ($q) {
            $sub->where('judul_buku', 'like', "%{$q}%")
                ->orWhere('pengarang', 'like', "%{$q}%")
                ->orWhere('isbn', 'like', "%{$q}%");
        });
    }

    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }

    $buku = $query->orderBy('judul_buku')->get();
    $kategori = Kategori::orderBy('nama_kategori')->get();

    return view('buku.index', compact('buku', 'kategori'));
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
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        Buku::create($request->all());
        if($request->hasFile('cover')){
            $data['cover']=$request->file('cover')->store('cover','public');
        }
        buku::create($data);
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
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $data=$request->all();
        if($request->hasFile('cover')){
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }
        $buku = Buku::findOrFail($id);
        $buku->update($data);
        return redirect()->route('buku.index');
    }
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index');
    }
}