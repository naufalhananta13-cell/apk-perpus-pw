<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                    <span>🔄</span> {{ __('Transaksi Peminjaman Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pantau sirkulasi peminjaman, pengembalian buku, dan status keterlambatan.</p>
            </div>
            <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-medium text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-1.5 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Transaksi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Alert Notifikasi Sukses --}}
            @if(session('success'))
                <div class="flex items-center p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Tabel Transaksi Peminjaman --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-600">No</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">Peminjam (Anggota)</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">Buku Dipinjam</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">Tanggal Pinjam</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">Tanggal Kembali</th>
                                <th class="px-6 py-4 font-semibold text-gray-600 text-center">Status</th>
                                <th class="px-6 py-4 font-semibold text-gray-600 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($peminjaman as $index => $item)
                                <tr class="hover:bg-gray-50/80 transition duration-150">
                                    <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->anggota->nama ?? '-' }}</div>
                                        <div class="text-xs font-mono text-gray-400 mt-0.5">{{ $item->anggota->kode_anggota ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->buku->judul ?? '-' }}</div>
                                        <div class="text-xs font-mono text-gray-400 mt-0.5">{{ $item->buku->kode_buku ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        @if($item->tanggal_kembali)
                                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d M Y') }}
                                        @else
                                            <span class="text-gray-400 italic">Belum kembali</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($item->status == 'dipinjam')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                <svg class="w-3.5 h-3.5 mr-1 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="inline-flex items-center gap-1.5">
                                            @if($item->status == 'dipinjam')
                                                <form action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-cyan-50 hover:bg-cyan-100 text-cyan-700 text-xs font-medium rounded-lg transition duration-150">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-medium rounded-lg transition duration-150">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                            </svg>
                                            <p class="text-base font-medium text-gray-600">Belum ada transaksi peminjaman</p>
                                            <p class="text-xs text-gray-400 mt-1">Buat transaksi baru untuk mencatat peminjaman buku oleh anggota.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
