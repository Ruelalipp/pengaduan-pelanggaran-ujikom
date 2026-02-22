@extends('layouts.siswa')

@section('page-content')
<!-- Welcome Header -->
<div class="bg-gradient-to-r from-red-600 to-rose-700 text-white rounded-2xl p-6 lg:p-8 mb-6 animate-slideUp relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -mr-10 -mt-10"></div>
    <div class="relative z-10">
        <h1 class="text-2xl lg:text-3xl font-extrabold mb-2">Selamat Datang! 👋</h1>
        <p class="text-red-100">Halo, <span class="font-semibold text-white">{{ session('siswa')->username ?? 'Siswa' }}</span>. Apa yang ingin kamu laporkan hari ini?</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-5 border-l-4 border-red-500 card-hover animate-slideUp delay-100">
        <p class="text-xs lg:text-sm text-gray-500">Total Laporan</p>
        <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $totalAspirasi ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-5 border-l-4 border-amber-500 card-hover animate-slideUp delay-200">
        <p class="text-xs lg:text-sm text-gray-500">Menunggu</p>
        <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $menunggu ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-5 border-l-4 border-orange-500 card-hover animate-slideUp delay-300">
        <p class="text-xs lg:text-sm text-gray-500">Proses</p>
        <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $proses ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-5 border-l-4 border-emerald-500 card-hover animate-slideUp delay-400">
        <p class="text-xs lg:text-sm text-gray-500">Selesai</p>
        <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $selesai ?? 0 }}</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid md:grid-cols-2 gap-4 mb-6">
    <a href="{{ route('siswa.aspirasi.create') }}" 
        class="bg-white rounded-xl shadow-sm p-5 card-hover group flex items-center gap-4 animate-slideUp delay-200">
        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center group-hover:bg-red-100 transition-colors duration-300">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </div>
        <div>
            <h3 class="font-semibold text-gray-800">Buat Laporan Baru</h3>
            <p class="text-sm text-gray-500">Laporkan pelanggaran yang terjadi</p>
        </div>
    </a>
    <a href="{{ route('siswa.aspirasi.histori') }}" 
        class="bg-white rounded-xl shadow-sm p-5 card-hover group flex items-center gap-4 animate-slideUp delay-300">
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-300">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <h3 class="font-semibold text-gray-800">Lihat Histori</h3>
            <p class="text-sm text-gray-500">Laporan yang sudah selesai</p>
        </div>
    </a>
</div>

<!-- Recent Reports -->
@if(isset($recentAspirasi) && $recentAspirasi->count() > 0)
<div class="bg-white rounded-xl shadow-sm animate-slideUp delay-400">
    <div class="px-5 py-4 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-800">Laporan Terbaru</h3>
        <a href="{{ route('siswa.aspirasi.index') }}" class="text-red-600 text-sm hover:text-red-700 font-medium hover:underline transition-colors duration-200">Lihat Semua →</a>
    </div>
    <div class="divide-y">
        @foreach($recentAspirasi as $item)
            <a href="{{ route('siswa.aspirasi.show', $item->id) }}" class="block px-5 py-4 hover:bg-red-50/30 transition-colors duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-800 truncate">{{ Str::limit($item->inputAspirasi->keterangan ?? '-', 60) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    @php $c = ['Menunggu' => 'bg-amber-100 text-amber-800', 'Proses' => 'bg-orange-100 text-orange-800', 'Selesai' => 'bg-emerald-100 text-emerald-800']; @endphp
                    <span class="ml-3 px-2.5 py-1 text-xs rounded-full font-medium {{ $c[$item->status] ?? 'bg-gray-100' }}">{{ $item->status }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
@endsection