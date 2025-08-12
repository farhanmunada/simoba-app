<?php
// database/seeders/MobilSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mobil')->insert([
            [
                'nama_mobil' => 'Toyota Avanza',
                'nomor_polisi' => 'B 1234 ABC',
                'keterangan' => 'Mobil dinas untuk kegiatan operasional',
            ],
            [
                'nama_mobil' => 'Honda Civic',
                'nomor_polisi' => 'B 5678 DEF',
                'keterangan' => 'Mobil dinas untuk pejabat',
            ],
            [
                'nama_mobil' => 'Daihatsu Xenia',
                'nomor_polisi' => 'B 9012 GHI',
                'keterangan' => 'Mobil dinas untuk perjalanan dinas',
            ],
        ]);

        $this->command->info('Data mobil berhasil dimasukkan.');
    }
}
