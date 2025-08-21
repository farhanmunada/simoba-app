<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GantiOli extends Model
{
    use HasFactory;

    protected $table = 'ganti_oli';

    protected $fillable = [
        'id_mobil',
        'tanggal_ganti',
        'km_saat_ganti',
        'km_target_berikutnya',
        'catatan',
        'petugas_input',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }
}
