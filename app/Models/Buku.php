<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // Nama tabel di database (jika tidak plural)
    protected $table = 'buku';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}