<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Transaksi Peminjaman Baru
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pilih anggota dan judul buku yang akan dipinjam.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition duration-150">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm">
                        <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="anggota_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Pilih Anggota</label>
                        <select name="anggota_id" id="anggota_id" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('anggota_id') border-rose-500 @enderror">
                            <option value="">-- Pilih Anggota Peminjam --</option>
                            @foreach($anggota as $item)
                                <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                    [{{ $item->kode_anggota }}] {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="buku_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('buku_id') border-rose-500 @enderror">
                            <option value="">-- Pilih Buku yang Tersedia --</option>
                            @foreach($buku as $item)
                                <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                    [{{ $item->kode_buku }}] {{ $item->judul }} (Sisa Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_pinjam" class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('tanggal_pinjam') border-rose-500 @enderror">
                        @error('tanggal_pinjam')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('peminjaman.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-medium rounded-xl shadow-sm transition duration-150 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Transaksi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
