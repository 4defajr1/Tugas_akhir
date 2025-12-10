<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\peminjam;
use App\Models\buku;



class DetailPeminjam extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjam';
    protected $fillable = [
        'peminjam_id', 
        'buku_id', 
        'tanggal_kembali', 
        'denda'
    ];

    // public function peminjam()
    // {
    //     return $this->belongsTo(peminjam::class, 'peminjam_id');
    // }

    // public function buku()
    // {
    //     return $this->belongsTo(buku::class, 'buku_id');
    // }

    public function peminjam()
        {
            return $this->belongsTo(Peminjam::class, 'peminjam_id');
        }

        // public function anggota()
        // {
        //     return $this->belongsTo(Anggota::class);
        // }

        public function buku()
        {
            return $this->belongsTo(Buku::class);
        }
        public function anggota()
        {
            return $this->belongsTo(Anggota::class, 'anggota_id');
        }
}
