<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Mobil;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $mobils = Mobil::all()->map(function ($mobil) use ($now) {
            $peminjamanAktif = Peminjaman::where('mobil_id', $mobil->id)
                ->where('waktu_mulai', '<=', $now)
                ->where('waktu_selesai', '>=', $now)
                ->first();

            $peminjamanMendatang = Peminjaman::where('mobil_id', $mobil->id)
                ->where('waktu_mulai', '>', $now)
                ->orderBy('waktu_mulai', 'asc')
                ->first();

            if ($peminjamanAktif) {
                $mobil->status = 'Sedang Digunakan';
                $mobil->warna = 'danger';
                $mobil->keterangan = 'Dipakai hingga ' . $peminjamanAktif->waktu_selesai->format('H:i');
            } elseif ($peminjamanMendatang) {
                $mobil->status = 'Sudah Dibooking';
                $mobil->warna = 'warning';
                $mobil->keterangan = 'Dibooking mulai ' . $peminjamanMendatang->waktu_mulai->format('H:i');
            } else {
                $mobil->status = 'Tersedia';
                $mobil->warna = 'success';
                $mobil->keterangan = 'Belum ada jadwal peminjaman';
            }

            return $mobil;
        });

        $riwayat = Peminjaman::where('waktu_selesai', '<', $now)
            ->orderBy('waktu_selesai', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('mobils', 'riwayat'));
    }
}
