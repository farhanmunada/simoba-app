<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'bidang_id',
        'mobil_id',
        'waktu_peminjaman',
        'tempat_kegiatan',
        'nama_acara',
        'penanggung_jawab'
    ];

    protected $casts = [
        'waktu_peminjaman' => 'datetime',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}