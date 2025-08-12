<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        $bidangs = ['Sekretariat', 'Litbang', 'PEIPD', 'ESDI', 'PPMP'];

        foreach ($bidangs as $bidang) {
            Bidang::create([
                'nama_bidang' => $bidang
            ]);
        }
    }
}
