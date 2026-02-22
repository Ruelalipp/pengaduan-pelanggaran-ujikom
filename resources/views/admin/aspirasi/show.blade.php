@extends('layouts.admin')

@section('page-title', 'Detail Aspirasi')

@section('page-content')
<div class="max-w-4xl">
    <!-- Back Button -->
    <a href="{{ route('admin.aspirasi.index') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 mb-6 transition-colors duration-200 group">
        <svg class="w-5 h-5 mr-1 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="grid gap-6">
        <!-- Detail Aspirasi -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-slideUp">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Informasi Aspirasi</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Pengirim</p>
                    <p class="font-semibold">{{ $aspirasi->inputAspirasi->siswa->username ?? '-' }}</p>
                    <p class="text-sm text-gray-500">NIS: {{ $aspirasi->inputAspirasi->siswa->nis ?? '-' }} | Kelas: {{ $aspirasi->inputAspirasi->siswa->kelas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jenis Pelaku</p>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium">{{ ucfirst($aspirasi->inputAspirasi->pelaku->type ?? '-') }}</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Laporan</p>
                    <p class="font-semibold">{{ $aspirasi->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Saat Ini</p>
                    @php
                        $colors = ['Menunggu' => 'bg-amber-100 text-amber-800', 'Proses' => 'bg-orange-100 text-orange-800', 'Selesai' => 'bg-emerald-100 text-emerald-800'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $colors[$aspirasi->status] ?? 'bg-gray-100' }}">{{ $aspirasi->status }}</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">Keterangan / Isi Laporan</p>
                <p class="mt-1 text-gray-800 whitespace-pre-line">{{ $aspirasi->inputAspirasi->keterangan ?? '-' }}</p>
            </div>
            @if($aspirasi->inputAspirasi->gambar)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Bukti Gambar</p>
                    <img src="{{ asset($aspirasi->inputAspirasi->gambar) }}" alt="Bukti" class="max-w-md rounded-xl border shadow-sm hover:shadow-lg transition-shadow duration-300">
                </div>
            @endif
        </div>

        <!-- Update Status -->
        @if(!$aspirasi->is_archived && !request('readonly'))
        <div class="bg-white rounded-xl shadow-sm p-6 animate-slideUp delay-100">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.aspirasi.updateStatus', $aspirasi->id) }}" class="flex flex-col sm:flex-row gap-4">
                @csrf
                @method('PATCH')
                <select name="status" class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                    <option value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Proses" {{ $aspirasi->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Update Status</button>
            </form>
        </div>
        @endif

        <!-- Feedback Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-slideUp delay-200">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Umpan Balik / Feedback</h3>
            @if($aspirasi->feedback)
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                    <p class="text-sm text-gray-600 mb-1">Feedback sebelumnya:</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $aspirasi->feedback }}</p>
                    @if($aspirasi->gambar)
                        <img src="{{ asset($aspirasi->gambar) }}" alt="Feedback" class="mt-3 max-w-md rounded-xl border shadow-sm hover:shadow-lg transition-shadow duration-300">
                    @endif
                </div>
            @endif
            @if(!$aspirasi->is_archived && !request('readonly'))
            <form method="POST" action="{{ route('admin.aspirasi.updateFeedback', $aspirasi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <textarea name="feedback" rows="4" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 mb-3 transition-all duration-300 hover:border-gray-300"
                    placeholder="Tulis umpan balik untuk siswa...">{{ old('feedback', $aspirasi->feedback) }}</textarea>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">Upload Gambar (opsional)</label>
                        <input type="file" name="gambar" accept="image/*" class="text-sm">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-green-600 text-white rounded-xl hover:from-emerald-700 hover:to-green-700 transition-all duration-300 btn-hover font-medium">Simpan Feedback</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
