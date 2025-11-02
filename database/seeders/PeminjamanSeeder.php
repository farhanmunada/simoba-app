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
                'waktu_mulai' => Carbon::now()->setHour(8)->setMinute(0)->setSecond(0),
                'waktu_selesai' => Carbon::now()->setHour(12)->setMinute(0)->setSecond(0),
                'tempat_kegiatan' => 'Kecamatan Tembarak',
                'nama_acara' => 'Rapat Koordinasi',
                'penanggung_jawab' => 'Budi Santoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bidang_id' => 2,
                'mobil_id' => 2,
                'waktu_mulai' => Carbon::tomorrow()->setHour(9)->setMinute(0)->setSecond(0),
                'waktu_selesai' => Carbon::tomorrow()->setHour(11)->setMinute(0)->setSecond(0),
                'tempat_kegiatan' => 'Kecamatan Kandangan',
                'nama_acara' => 'Monitoring Proyek',
                'penanggung_jawab' => 'Siti Rahmawati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
