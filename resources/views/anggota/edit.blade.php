<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Edit Data Anggota
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui data anggota perpustakaan "{{ $anggota->nama }}".</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition duration-150">
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

                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="kode_anggota" class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Anggota</label>
                        <input type="text" name="kode_anggota" id="kode_anggota" value="{{ old('kode_anggota', $anggota->kode_anggota) }}" required
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('kode_anggota') border-rose-500 @enderror">
                        @error('kode_anggota')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}" required
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('nama') border-rose-500 @enderror">
                        @error('nama')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="jk" class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Kelamin</label>
                            <select name="jk" id="jk" required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('jk') border-rose-500 @enderror">
                                <option value="L" {{ old('jk', $anggota->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk', $anggota->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Handphone (HP)</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $anggota->no_hp) }}"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('no_hp') border-rose-500 @enderror">
                            @error('no_hp')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Tempat Tinggal</label>
                        <textarea name="alamat" id="alamat" rows="3"
                                  class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:border-indigo-500 transition duration-150 @error('alamat') border-rose-500 @enderror">{{ old('alamat', $anggota->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('anggota.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white text-sm font-medium rounded-xl shadow-sm transition duration-150 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perbarui Data Anggota
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
