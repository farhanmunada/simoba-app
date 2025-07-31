<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Mobil;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user
        User::create([
            'username' => 'admin',
            'password' => 'admin123', // Plain text password
        ]);

        // Create sample bidang
        $bidangData = [
            'Sekretariat',
            'Bidang Penelitian dan Pengembangan (Litbang)',
            'Bidang Perencanaan Ekonomi dan Infrastruktur Pembangunan Daerah (PEIPD)',
            'Bidang Evaluasi dan Sistem Data Informasi (ESDI)',
            'Bidang Perencanaan Pemerintahan dan Manajemen Pembangunan (PPMP)',
        ];

        foreach ($bidangData as $nama) {
            Bidang::create(['nama_bidang' => $nama]);
        }

        // Create sample mobil
        $mobilData = [
            [
                'nama_mobil' => 'Toyota Avanza',
                'nomor_polisi' => 'B 1234 ABC',
                'keterangan' => 'Mobil dinas untuk kegiatan operasional'
            ],
            [
                'nama_mobil' => 'Honda Civic',
                'nomor_polisi' => 'B 5678 DEF',
                'keterangan' => 'Mobil dinas untuk pejabat'
            ],
            [
                'nama_mobil' => 'Daihatsu Xenia',
                'nomor_polisi' => 'B 9012 GHI',
                'keterangan' => 'Mobil dinas untuk perjalanan dinas'
            ],
        ];

        foreach ($mobilData as $data) {
            Mobil::create($data);
        }
    }
}