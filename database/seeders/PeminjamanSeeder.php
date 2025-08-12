<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peminjaman')->insert([
            [
                'bidang_id' => 1,
                'mobil_id' => 1,
                'waktu_peminjaman' => Carbon::now(),
                'tempat_kegiatan' => 'Kecamatan Tembarak',
                'nama_acara' => 'Rapat Koordinasi',
                'penanggung_jawab' => 'Budi Santoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 2,
                'mobil_id' => 2,
                'waktu_peminjaman' => Carbon::tomorrow(),
                'tempat_kegiatan' => 'Kecamatan Kandangan',
                'nama_acara' => 'Monitoring Proyek',
                'penanggung_jawab' => 'Siti Rahmawati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
