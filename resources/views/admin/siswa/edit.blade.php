@extends('layouts.admin')

@section('page-title', 'Edit Siswa')

@section('page-content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6 animate-scaleIn">
    <h2 class="text-lg font-bold text-gray-800 mb-6">Form Edit Siswa</h2>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">NIS</label>
            <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300 @error('nis') border-red-500 @enderror" required>
            @error('nis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $siswa->username) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300 @error('username') border-red-500 @enderror" required>
            @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
            <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300 @error('kelas') border-red-500 @enderror" required>
            @error('kelas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password (Opsional)</label>
            <input type="password" name="password" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300 @error('password') border-red-500 @enderror" placeholder="Isi hanya jika ingin mengganti password">
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.siswa.index') }}" class="px-5 py-2.5 text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
