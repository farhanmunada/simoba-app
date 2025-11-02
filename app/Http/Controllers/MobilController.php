<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mobil;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::all();
        return view('mobil.index', compact('mobil'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255|unique:mobil,nomor_polisi',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Simpan gambar ke storage/app/public/mobil
            $path = $request->file('gambar')->store('mobil', 'public');
            // Ambil nama file saja dari path yang dihasilkan
            $data['gambar'] = basename($path);
        }

        Mobil::create($data);

        // Pastikan symbolic link sudah dibuat dengan `php artisan storage:link`
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil ditambahkan!');
    }

    public function show(Mobil $mobil)
    {
        return view('mobil.show', compact('mobil'));
    }

    public function edit(Mobil $mobil)
    {
        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255|unique:mobil,nomor_polisi,' . $mobil->id, // Koreksi tabel 'mobil'
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($mobil->gambar) {
                Storage::disk('public')->delete('mobil/' . $mobil->gambar);
            }

            // Simpan gambar baru
            $path = $request->file('gambar')->store('mobil', 'public');
            $data['gambar'] = basename($path);
        }

        $mobil->update($data);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(Mobil $mobil)
    {
        // Hapus gambar dari storage jika ada, sebelum menghapus record dari database
        if ($mobil->gambar) {
            Storage::disk('public')->delete('mobil/' . $mobil->gambar);
        }

        $mobil->delete();
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus!');
    }
}
