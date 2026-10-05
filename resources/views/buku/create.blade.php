<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Tambah Buku Baru
                </h2>
                <p class="text-sm text-gray-500 mt-1">Masukkan data lengkap buku untuk menambahkan ke katalog perpustakaan.</p>
            </div>
            <a href="{{ route('buku.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition duration-150">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm">
                        <div class="font-semibold mb-2">Terjadi kesalahan pada input data:</div>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buku.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="kode_buku" class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Buku</label>
                        <input type="text" name="kode_buku" id="kode_buku" value="{{ old('kode_buku') }}" required placeholder="Contoh: BK-001"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('kode_buku') border-rose-500 @enderror">
                        @error('kode_buku')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Buku</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul buku..."
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('judul') border-rose-500 @enderror">
                        @error('judul')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="pengarang" class="block text-sm font-semibold text-gray-700 mb-1.5">Pengarang</label>
                            <input type="text" name="pengarang" id="pengarang" value="{{ old('pengarang') }}" required placeholder="Nama penulis / pengarang"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('pengarang') border-rose-500 @enderror">
                            @error('pengarang')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1.5">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" required placeholder="Nama penerbit"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('penerbit') border-rose-500 @enderror">
                            @error('penerbit')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', date('Y')) }}" required placeholder="Contoh: 2024"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('tahun_terbit') border-rose-500 @enderror">
                            @error('tahun_terbit')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Stok</label>
                            <input type="number" min="0" name="stok" id="stok" value="{{ old('stok', 1) }}" required placeholder="Jumlah buku tersedia"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('stok') border-rose-500 @enderror">
                            @error('stok')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('buku.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-medium rounded-xl shadow-sm transition duration-150 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Data Buku
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>