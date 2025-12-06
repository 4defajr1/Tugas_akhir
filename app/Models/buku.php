<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = [
        'judul_buku', 
        'pengarang', 
        'penerbit', 
        'tahun_terbit', 
        'isbn', 
        'stock', 
        'kategori_id'
    ];
    //1 buku hanya memiliki 1 kategori
    public function kategori(){
        return $this->belongsTo(kategori::class, 'kategori_id');    
    }
public function detailPeminjam(){
        return $this->hasMany(detailPeminjam::class, 'buku_id');
    }
}
