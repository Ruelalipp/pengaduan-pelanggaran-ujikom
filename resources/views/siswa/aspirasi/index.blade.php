@extends('layouts.siswa')

@section('page-content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3 animate-slideUp">
    <h1 class="text-2xl font-bold text-gray-800">Aspirasi Saya</h1>
    <a href="{{ route('siswa.aspirasi.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Laporan
    </a>
</div>

<!-- Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6 animate-slideUp delay-100">
    <form method="GET" class="flex flex-col sm:flex-row gap-3">
        <select name="status" class="px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
            <option value="">Semua Status</option>
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Filter</button>
        <a href="{{ route('siswa.aspirasi.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 text-center font-medium">Reset</a>
    </form>
</div>

<!-- List -->
<div class="space-y-3">
    @forelse($aspirasi as $item)
        <a href="{{ route('siswa.aspirasi.show', $item->id) }}" class="block bg-white rounded-xl shadow-sm p-5 card-hover group animate-slideUp delay-200">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600 font-medium">{{ ucfirst($item->inputAspirasi->pelaku->type ?? '-') }}</span>
                        @php $colors = ['Menunggu' => 'bg-amber-100 text-amber-800', 'Proses' => 'bg-orange-100 text-orange-800', 'Selesai' => 'bg-emerald-100 text-emerald-800']; @endphp
                        <span class="px-2.5 py-0.5 text-xs rounded-full font-medium {{ $colors[$item->status] ?? 'bg-gray-100' }}">{{ $item->status }}</span>
                    </div>
                    <p class="text-gray-800 mb-1">{{ Str::limit($item->inputAspirasi->keterangan ?? '-', 100) }}</p>
                    <p class="text-xs text-gray-500">{{ $item->created_at->format('d F Y, H:i') }}</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 ml-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center animate-scaleIn">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="text-gray-500 mb-4">Belum ada laporan aspirasi</p>
            <a href="{{ route('siswa.aspirasi.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 inline-block transition-all duration-300 btn-hover font-medium">Buat Laporan Pertama</a>
        </div>
    @endforelse
</div>

@if($aspirasi->hasPages())<div class="mt-6">{{ $aspirasi->links() }}</div>@endif
@endsection
