<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GantiOli;
use App\Models\Mobil;

class GantiOliController extends Controller
{
    // Tampilkan dashboard + monitoring + form input
    public function index()
    {
        $gantiOli = GantiOli::with('mobil')
            ->orderBy('tanggal_ganti', 'desc') // urut terbaru dulu
            ->orderBy('id_mobil')             // lalu per mobil
            ->get()
            ->groupBy('id_mobil');            // grup per mobil

        return view('gantioli.index', compact('gantiOli'));
    }

    public function create()
    {
        $mobil = Mobil::all(); // Ambil daftar mobil untuk dropdown
        return view('gantioli.create', compact('mobil'));
    }

    // Simpan data ganti oli (Create)
    public function store(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required|exists:mobil,id',
            'tanggal_ganti' => 'required|date',
            'km_saat_ganti' => 'required|integer|min:0',
            'petugas_input' => 'required|string|max:100',
        ]);

        $interval_km = 5000; // misal interval ganti oli 5000 km
        $km_target = $request->km_saat_ganti + $interval_km;

        GantiOli::create([
            'id_mobil' => $request->id_mobil,
            'tanggal_ganti' => $request->tanggal_ganti,
            'km_saat_ganti' => $request->km_saat_ganti,
            'km_target_berikutnya' => $km_target,
            'catatan' => $request->catatan,
            'petugas_input' => $request->petugas_input,
        ]);

        return redirect()->route('ganti-oli.index')->with('success', 'Data ganti oli berhasil disimpan!');
    }

    // Tampilkan form edit (optional jika pakai modal)
    public function edit($id)
    {
        $gantiOli = GantiOli::findOrFail($id);
        $mobil = Mobil::all();

        return view('gantioli.edit', compact('gantiOli', 'mobil'));
    }

    // Update data ganti oli (Update)
    public function update(Request $request, $id)
    {
        $gantiOli = GantiOli::findOrFail($id);

        $request->validate([
            'id_mobil' => 'required|exists:mobil,id',
            'tanggal_ganti' => 'required|date',
            'km_saat_ganti' => 'required|integer|min:0',
            'petugas_input' => 'required|string|max:100',
        ]);

        $interval_km = 5000;
        $km_target = $request->km_saat_ganti + $interval_km;

        $gantiOli->update([
            'id_mobil' => $request->id_mobil,
            'tanggal_ganti' => $request->tanggal_ganti,
            'km_saat_ganti' => $request->km_saat_ganti,
            'km_target_berikutnya' => $km_target,
            'catatan' => $request->catatan,
            'petugas_input' => $request->petugas_input,
        ]);

        return redirect()->route('ganti-oli.index')
            ->with('success', 'Data ganti oli berhasil diupdate.');
    }

    // Hapus data ganti oli (Delete)
    public function destroy($id)
    {
        $gantiOli = GantiOli::findOrFail($id);
        $gantiOli->delete();

        return redirect()->back()->with('success', 'Data ganti oli berhasil dihapus!');
    }
}
