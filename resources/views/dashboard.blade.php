<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Perpustakaan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, <span class="font-semibold text-indigo-600">{{ Auth::user()->name }}</span>! Berikut ringkasan operasional sistem perpustakaan.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-sm transition duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Peminjaman Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- Total Buku --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Judul Buku</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalBuku }}</h3>
                        <a href="{{ route('buku.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 mt-2 inline-flex items-center gap-1">
                            Lihat semua buku &rarr;
                        </a>
                    </div>
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl">
                        📚
                    </div>
                </div>

                {{-- Total Stok --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Stok Buku</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalStok }}</h3>
                        <p class="text-xs text-gray-400 mt-2">Eksemplar fisik tersedia</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                        📦
                    </div>
                </div>

                {{-- Total Anggota --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Anggota</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalAnggota }}</h3>
                        <a href="{{ route('anggota.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 mt-2 inline-flex items-center gap-1">
                            Kelola anggota &rarr;
                        </a>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        👤
                    </div>
                </div>

                {{-- Peminjaman Aktif --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $peminjamanAktif }}</h3>
                        <a href="{{ route('peminjaman.index') }}" class="text-xs font-medium text-amber-600 hover:text-amber-700 mt-2 inline-flex items-center gap-1">
                            Lihat sirkulasi &rarr;
                        </a>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl">
                        🔄
                    </div>
                </div>
            </div>

            {{-- Quick Links & Transaksi Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Quick Actions --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                    <h3 class="font-bold text-gray-900 text-base">Aksi Cepat</h3>
                    <div class="space-y-2.5">
                        <a href="{{ route('buku.create') }}" class="flex items-center p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 hover:text-indigo-700 transition duration-150 group">
                            <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm mr-3">
                                ➕
                            </span>
                            <div class="text-sm font-medium text-gray-800 group-hover:text-indigo-700">Tambah Koleksi Buku</div>
                        </a>
                        <a href="{{ route('anggota.create') }}" class="flex items-center p-3 rounded-xl bg-gray-50 hover:bg-blue-50 hover:text-blue-700 transition duration-150 group">
                            <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm mr-3">
                                👤
                            </span>
                            <div class="text-sm font-medium text-gray-800 group-hover:text-blue-700">Daftarkan Anggota Baru</div>
                        </a>
                        <a href="{{ route('peminjaman.create') }}" class="flex items-center p-3 rounded-xl bg-gray-50 hover:bg-amber-50 hover:text-amber-700 transition duration-150 group">
                            <span class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center text-sm mr-3">
                                📖
                            </span>
                            <div class="text-sm font-medium text-gray-800 group-hover:text-amber-700">Catat Transaksi Peminjaman</div>
                        </a>
                    </div>
                </div>

                {{-- Transaksi Terakhir --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-900 text-base">Aktivitas Peminjaman Terbaru</h3>
                        <a href="{{ route('peminjaman.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                            Semua Transaksi &rarr;
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead>
                                <tr class="text-xs text-gray-400 border-b border-gray-100 pb-2">
                                    <th class="pb-3 font-medium">Peminjam</th>
                                    <th class="pb-3 font-medium">Buku</th>
                                    <th class="pb-3 font-medium">Tanggal</th>
                                    <th class="pb-3 font-medium text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($peminjamanTerbaru as $item)
                                    <tr>
                                        <td class="py-3 font-medium text-gray-900">
                                            {{ $item->anggota->nama ?? '-' }}
                                        </td>
                                        <td class="py-3 text-gray-600 max-w-[200px] truncate">
                                            {{ $item->buku->judul ?? '-' }}
                                        </td>
                                        <td class="py-3 text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-3 text-center">
                                            @if($item->status == 'dipinjam')
                                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                    Kembali
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-xs text-gray-400">
                                            Belum ada aktivitas transaksi peminjaman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
