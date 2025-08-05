<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Bidang;
use App\Models\Mobil;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $peminjaman = Peminjaman::with(['bidang', 'mobil'])
            ->orderBy('waktu_peminjaman', 'desc')
            ->get();

        $peminjamanHariIni = Peminjaman::with(['bidang', 'mobil'])
            ->whereDate('waktu_peminjaman', $today)
            ->orderBy('waktu_peminjaman', 'asc')
            ->get();

        $peminjamanMendatang = Peminjaman::with(['bidang', 'mobil'])
            ->whereDate('waktu_peminjaman', '>', $today)
            ->orderBy('waktu_peminjaman', 'asc')
            ->get();

        $riwayatPeminjaman = Peminjaman::with(['bidang', 'mobil'])
            ->whereDate('waktu_peminjaman', '<', $today)
            ->orderBy('waktu_peminjaman', 'desc')
            ->get();

        return view('peminjaman.index', compact(
            'peminjaman',
            'peminjamanHariIni',
            'peminjamanMendatang',
            'riwayatPeminjaman'
        ));
    }

    public function create(Request $request)
    {
        $tanggal = $request->input('waktu_peminjaman', Carbon::today()->toDateString());

        $mobilDipinjamHariIni = Peminjaman::whereDate('waktu_peminjaman', $tanggal)
            ->pluck('mobil_id')
            ->toArray();

        $mobil = Mobil::all();
        $bidang = Bidang::all();

        return view('peminjaman.create', compact('mobil', 'bidang', 'mobilDipinjamHariIni', 'tanggal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'mobil_id' => 'required|exists:mobil,id',
            'waktu_peminjaman' => 'required|date',
            'tempat_kegiatan' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Cek apakah peminjaman dengan mobil dan tanggal ini sudah ada
        $duplikat = Peminjaman::where('mobil_id', $request->mobil_id)
            ->whereDate('waktu_peminjaman', $request->waktu_peminjaman)
            ->exists();

        if ($duplikat) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['mobil_id' => 'Mobil ini sudah dipinjam pada tanggal tersebut.']);
        }

        // Simpan jika tidak duplikat
        Peminjaman::create($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $bidang = Bidang::all();
        $mobil = Mobil::all();
        return view('peminjaman.edit', compact('peminjaman', 'bidang', 'mobil'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'mobil_id' => 'required|exists:mobil,id',
            'waktu_peminjaman' => 'required|date',
            'tempat_kegiatan' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
