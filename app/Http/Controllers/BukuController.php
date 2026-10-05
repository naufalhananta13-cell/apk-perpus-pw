<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // A. Menampilkan Daftar Buku (Read) dengan Fitur Pencarian (Judul / Pengarang)
    public function index(Request $request)
    {
        $search = $request->query('search');

        $buku = Buku::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('pengarang', 'like', "%{$search}%")
                         ->orWhere('kode_buku', 'like', "%{$search}%");
        })->latest()->get();

        return view('buku.index', compact('buku', 'search'));
    }

    // B. Menampilkan Form Tambah Buku
    public function create()
    {
        return view('buku.create');
    }

    // C. Menyimpan Data Buku Baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku'    => 'required|unique:buku,kode_buku',
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    // D. Menampilkan Form Edit Buku
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    // E. Memperbarui Data Buku (Update)
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku'    => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diperbarui');
    }

    // F. Menghapus Data Buku (Delete)
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil dihapus');
    }
}