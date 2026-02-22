@extends('layouts.siswa')

@section('page-content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('siswa.aspirasi.index') }}" class="inline-flex items-center text-gray-600 hover:text-red-600 mb-6 transition-colors duration-200 group">
        <svg class="w-5 h-5 mr-1 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <!-- Status Timeline -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 animate-slideUp">
        <h3 class="font-bold text-gray-800 mb-4">Status Progres</h3>
        <div class="flex items-center">
            @php
                $steps = ['Menunggu', 'Proses', 'Selesai'];
                $currentIndex = array_search($aspirasi->status, $steps);
            @endphp
            @foreach($steps as $index => $step)
                <div class="flex items-center {{ $index < count($steps) - 1 ? 'flex-1' : '' }}">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 {{ $index <= $currentIndex ? 'bg-red-500 text-white shadow-lg shadow-red-500/30' : 'bg-gray-200 text-gray-500' }}">
                            @if($index < $currentIndex)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs mt-1 font-medium {{ $index <= $currentIndex ? 'text-red-600' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                    @if($index < count($steps) - 1)
                        <div class="flex-1 h-1 mx-2 rounded {{ $index < $currentIndex ? 'bg-red-500' : 'bg-gray-200' }}"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Detail -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 animate-slideUp delay-100">
        <h3 class="font-bold text-gray-800 mb-4">Detail Laporan</h3>
        <div class="space-y-3">
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-500">Jenis Pelaku</span>
                <span class="font-medium">{{ ucfirst($aspirasi->inputAspirasi->pelaku->type ?? '-') }}</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-500">Tanggal Laporan</span>
                <span class="font-medium">{{ $aspirasi->created_at->format('d F Y, H:i') }}</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-500">Status</span>
                @php $colors = ['Menunggu' => 'bg-amber-100 text-amber-800', 'Proses' => 'bg-orange-100 text-orange-800', 'Selesai' => 'bg-emerald-100 text-emerald-800']; @endphp
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $colors[$aspirasi->status] ?? 'bg-gray-100' }}">{{ $aspirasi->status }}</span>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-sm text-gray-500 mb-1">Keterangan:</p>
            <p class="text-gray-800 whitespace-pre-line">{{ $aspirasi->inputAspirasi->keterangan ?? '-' }}</p>
        </div>
        @if($aspirasi->inputAspirasi->gambar)
            <div class="mt-4">
                <p class="text-sm text-gray-500 mb-2">Bukti:</p>
                <img src="{{ asset($aspirasi->inputAspirasi->gambar) }}" alt="Bukti" class="rounded-xl max-w-full border shadow-sm hover:shadow-lg transition-shadow duration-300">
            </div>
        @endif
    </div>

    <!-- Feedback -->
    @if($aspirasi->feedback)
        <div class="bg-red-50 rounded-xl shadow-sm p-6 border border-red-200 animate-slideUp delay-200">
            <h3 class="font-bold text-red-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                Umpan Balik dari Admin
            </h3>
            <p class="text-gray-800 whitespace-pre-line">{{ $aspirasi->feedback }}</p>
            @if($aspirasi->gambar)
                <img src="{{ asset($aspirasi->gambar) }}" alt="Feedback" class="mt-3 rounded-xl max-w-full border shadow-sm hover:shadow-lg transition-shadow duration-300">
            @endif
            <p class="text-xs text-gray-500 mt-3">Diupdate: {{ $aspirasi->updated_at->format('d F Y, H:i') }}</p>
        </div>
    @endif
</div>
@endsection
