<?php

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        Peminjaman::create([
            'user_id' => 1,
            'mobil_id' => 1,
            'tanggal_pinjam' => Carbon::now()->format('Y-m-d'),
            'waktu_pinjam' => '08:00',
            'tujuan' => 'Kantor Gubernur',
            'status' => 'Dipinjam'
        ]);

        Peminjaman::create([
            'user_id' => 2,
            'mobil_id' => 2,
            'tanggal_pinjam' => Carbon::now()->subDays(1)->format('Y-m-d'),
            'waktu_pinjam' => '09:30',
            'tujuan' => 'Kantor Kecamatan',
            'status' => 'Selesai'
        ]);
    }
}
