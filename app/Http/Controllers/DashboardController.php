<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Bidang;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $totalBidang = Bidang::count();
        $peminjamanHariIni = Peminjaman::whereDate('waktu_peminjaman', Carbon::today())->count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard', compact('totalMobil', 'totalBidang', 'peminjamanHariIni', 'totalPeminjaman'));
    }
}