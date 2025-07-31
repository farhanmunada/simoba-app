<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'nomor_polisi' => 'required|string|max:255|unique:mobil',
            'keterangan' => 'nullable|string',
        ]);

        Mobil::create($request->all());

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
            'nomor_polisi' => 'required|string|max:255|unique:mobil,nomor_polisi,' . $mobil->id,
            'keterangan' => 'nullable|string',
        ]);

        $mobil->update($request->all());

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus!');
    }
}