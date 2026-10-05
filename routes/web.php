<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $totalBuku = Buku::count();
    $totalStok = Buku::sum('stok');
    $totalAnggota = Anggota::count();
    $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
    $peminjamanTerbaru = Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get();

    return view('dashboard', compact('totalBuku', 'totalStok', 'totalAnggota', 'peminjamanAktif', 'peminjamanTerbaru'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Kelola Data Buku (Protected by Auth)
    Route::resource('buku', BukuController::class);

    // Kelola Data Anggota (Protected by Auth)
    Route::resource('anggota', AnggotaController::class);

    // Kelola Transaksi Peminjaman (Protected by Auth)
    Route::resource('peminjaman', PeminjamanController::class)->except(['edit', 'update']);
    Route::patch('peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

    // Profile Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

