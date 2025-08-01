<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Mobil;

class HomeController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $jadwalHariIni = Peminjaman::whereDate('waktu_peminjaman', $today)->get();
        $jadwalMendatang = Peminjaman::whereDate('waktu_peminjaman', '>', $today)->get();
        $riwayatPeminjaman = Peminjaman::whereDate('waktu_peminjaman', '<', $today)->get();

        $mobils = Mobil::all(); // Ambil semua mobil

        return view('home', compact('jadwalHariIni', 'jadwalMendatang', 'riwayatPeminjaman', 'mobils'));
    }
}
