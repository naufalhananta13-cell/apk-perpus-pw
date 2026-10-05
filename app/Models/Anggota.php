<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'jk',
        'no_hp',
        'alamat'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
