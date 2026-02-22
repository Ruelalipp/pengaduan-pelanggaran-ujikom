@extends('layouts.siswa')

@section('page-content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 animate-scaleIn">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Buat Laporan Baru</h2>

        <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Pelaku</label>
                <select name="type" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="siswa" {{ old('type') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ old('type') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="staff" {{ old('type') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="5" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300"
                    placeholder="Jelaskan kronologi pelanggaran secara detail...">{{ old('keterangan') }}</textarea>
                @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Bukti Gambar (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-600 hover:file:bg-red-100 transition-all duration-200">
                @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('siswa.aspirasi.index') }}" class="px-5 py-2.5 text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-medium">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
