<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::latest()->get();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_anggota' => 'required|unique:anggota,kode_anggota',
            'nama'         => 'required',
            'jk'           => 'required|in:L,P',
            'no_hp'        => 'nullable|numeric',
            'alamat'       => 'nullable',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'kode_anggota' => 'required|unique:anggota,kode_anggota,' . $anggota->id,
            'nama'         => 'required',
            'jk'           => 'required|in:L,P',
            'no_hp'        => 'nullable|numeric',
            'alamat'       => 'nullable',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil dihapus');
    }
}
