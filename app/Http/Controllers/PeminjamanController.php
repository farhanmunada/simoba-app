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
        $now = Carbon::now();

        $semuaPeminjaman = Peminjaman::with(['bidang', 'mobil'])
            ->orderBy('waktu_mulai', 'desc')
            ->get()
            ->map(function ($item) {
                // pastikan waktu_mulai & waktu_selesai adalah Carbon instance
                $item->waktu_mulai = Carbon::parse($item->waktu_mulai);
                $item->waktu_selesai = Carbon::parse($item->waktu_selesai);
                return $item;
            });

        $peminjamanBerlangsung = $semuaPeminjaman->filter(function ($item) use ($now) {
            return $now->between($item->waktu_mulai, $item->waktu_selesai);
        })->sortBy('waktu_selesai');

        $peminjamanMendatang = $semuaPeminjaman
            ->filter(function ($item) use ($now) {
                return $item->waktu_mulai->gt($now);
            })
            ->sortBy('waktu_mulai');

        $riwayatPeminjaman = $semuaPeminjaman
            ->filter(function ($item) use ($now) {
                return $item->waktu_selesai->lt($now);
            })
            ->sortByDesc('waktu_mulai');

        return view('peminjaman.index', compact(
            'peminjamanBerlangsung',
            'peminjamanMendatang',
            'riwayatPeminjaman'
        ));
    }


    public function create(Request $request)
    {
        $mobil = Mobil::all();
        $bidang = Bidang::all();

        // Ambil mobil_id dari request URL jika ada
        $selectedMobilId = $request->query('mobil_id');

        // Kita tidak lagi melakukan pra-filter mobil di sini karena ketersediaan
        // bergantung pada rentang waktu yang dinamis.
        // Validasi akan dilakukan sepenuhnya di backend saat submit.
        return view('peminjaman.create', compact('mobil', 'bidang', 'selectedMobilId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'mobil_id' => 'required|exists:mobil,id',
            'waktu_mulai' => 'required|date|after_or_equal:now',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tempat_kegiatan' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Logika baru: Cek jadwal yang tumpang tindih (overlap)
        $duplikat = Peminjaman::where('mobil_id', $request->mobil_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Peminjaman baru dimulai di tengah peminjaman lain
                    $q->where('waktu_mulai', '<', $request->waktu_mulai)
                        ->where('waktu_selesai', '>', $request->waktu_mulai);
                })->orWhere(function ($q) use ($request) {
                    // Peminjaman baru berakhir di tengah peminjaman lain
                    $q->where('waktu_mulai', '<', $request->waktu_selesai)
                        ->where('waktu_selesai', '>', $request->waktu_selesai);
                })->orWhere(function ($q) use ($request) {
                    // Peminjaman baru "menelan" peminjaman lain
                    $q->where('waktu_mulai', '>=', $request->waktu_mulai)
                        ->where('waktu_selesai', '<=', $request->waktu_selesai);
                });
            })
            ->exists();

        if ($duplikat) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['waktu_mulai' => 'Jadwal mobil pada rentang waktu tersebut sudah terisi. Silakan pilih waktu lain.']);
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
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tempat_kegiatan' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        // Logika baru: Cek jadwal yang tumpang tindih, kecuali untuk data itu sendiri
        $duplikat = Peminjaman::where('mobil_id', $request->mobil_id)
            ->where('id', '!=', $peminjaman->id) // Pengecualian untuk data yang sedang diedit
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('waktu_mulai', '<', $request->waktu_mulai)
                        ->where('waktu_selesai', '>', $request->waktu_mulai);
                })->orWhere(function ($q) use ($request) {
                    $q->where('waktu_mulai', '<', $request->waktu_selesai)
                        ->where('waktu_selesai', '>', $request->waktu_selesai);
                })->orWhere(function ($q) use ($request) {
                    $q->where('waktu_mulai', '>=', $request->waktu_mulai)
                        ->where('waktu_selesai', '<=', $request->waktu_selesai);
                });
            })
            ->exists();

        if ($duplikat) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['waktu_mulai' => 'Jadwal mobil pada rentang waktu tersebut sudah terisi oleh peminjam lain.']);
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
