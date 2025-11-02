<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';

    protected $fillable = [
        'nama_mobil',
        'nomor_polisi',
        'gambar',
        'keterangan',

    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
