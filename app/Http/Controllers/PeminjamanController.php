<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // C & D. Menampilkan Data Relasi (Eager Loading)
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    // Form Tambah Transaksi Peminjaman
    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $anggota = Anggota::all();
        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    // Simpan Transaksi Peminjaman Baru
    public function store(Request $request)
    {
        $request->validate([
            'buku_id'        => 'required|exists:buku,id',
            'anggota_id'     => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return back()->withErrors(['stok' => 'Stok buku ini sedang habis!'])->withInput();
        }

        // Simpan peminjaman
        Peminjaman::create([
            'buku_id'        => $request->buku_id,
            'anggota_id'     => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status'         => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Transaksi peminjaman berhasil disimpan');
    }

    // Pengembalian Buku
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->update([
                'status'          => 'dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            // Kembalikan stok buku
            $peminjaman->buku()->increment('stok');
        }

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Buku berhasil dikembalikan');
    }

    // Hapus Transaksi Peminjaman
    public function destroy(Peminjaman $peminjaman)
    {
        // Jika dihapus saat status dipinjam, kembalikan stoknya
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku()->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data transaksi peminjaman berhasil dihapus');
    }
}
