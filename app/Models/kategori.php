<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\buku;
use App\Models\detailPeminjam;
use App\Models\peminjam;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'deskripsi'];
//1 kategori bisa memiliki banyak buku
    public function buku()
    {
        return $this->hasMany(buku::class, 'kategori_id');
    }
}
