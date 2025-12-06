<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\DetailPeminjam;
use App\Models\Anggota;

class Peminjam extends Model
{
    use HasFactory;
    protected $table = 'peminjam';
    protected $fillable = [
        'anggota_id', 
        'tanggal_pinjam', 
        'tanggal_jatuh_tempo', 
        'status'
    ];
    //ralassi 
    //1 peminjam hanya dimiliki oleh 1 anggota
    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'anggota_id');
    }
    //realasi tabel detailpeminjam dan peminjam
    //1 peminjam memiliki banyak detailPeminjam
    public function detailPeminjam()
    {
        return $this->hasMany(detailPeminjam::class, 'peminjam_id');
    }
    
}
