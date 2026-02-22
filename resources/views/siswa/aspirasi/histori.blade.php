@extends('layouts.siswa')

@section('page-content')
<h1 class="text-2xl font-bold text-gray-800 mb-6 animate-slideUp">Histori Aspirasi</h1>

<div class="space-y-3">
    @forelse($aspirasi as $item)
        <a href="{{ route('siswa.aspirasi.show', $item->id) }}" class="block bg-white rounded-xl shadow-sm p-5 border-l-4 border-emerald-500 card-hover group animate-slideUp delay-100">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600 font-medium">{{ ucfirst($item->inputAspirasi->pelaku->type ?? '-') }}</span>
                        <span class="px-2.5 py-0.5 text-xs rounded-full bg-emerald-100 text-emerald-800 font-medium">Selesai</span>
                    </div>
                    <p class="text-gray-800 mb-1">{{ Str::limit($item->inputAspirasi->keterangan ?? '-', 100) }}</p>
                    <p class="text-xs text-gray-500">Selesai: {{ $item->updated_at->format('d F Y, H:i') }}</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 ml-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center animate-scaleIn">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-gray-500">Belum ada aspirasi yang selesai</p>
        </div>
    @endforelse
</div>

@if($aspirasi->hasPages())<div class="mt-6">{{ $aspirasi->links() }}</div>@endif
@endsection
