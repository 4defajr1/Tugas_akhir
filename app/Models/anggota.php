<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $fillable = [
        'user_id',
        'nama', 
        'nim_nid', 
        'alamat', 
        'no_hp', 
        'email', 
        'status'
    ];
    //1 anggota bisa memiliki banyak peminjam
    public function peminjam()
    {
        return $this->hasMany(peminjam::class, 'anggota_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
