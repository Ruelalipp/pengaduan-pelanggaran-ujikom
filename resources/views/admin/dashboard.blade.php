@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('page-content')
<!-- Stats Cards -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 lg:gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-l-4 border-red-500 card-hover animate-slideUp">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs lg:text-sm text-gray-500">Total Aspirasi</p>
                <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $totalAspirasi }}</p>
            </div>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-red-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-l-4 border-amber-500 card-hover animate-slideUp delay-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs lg:text-sm text-gray-500">Menunggu</p>
                <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $menunggu }}</p>
            </div>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-amber-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-l-4 border-orange-500 card-hover animate-slideUp delay-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs lg:text-sm text-gray-500">Proses</p>
                <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $proses }}</p>
            </div>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-l-4 border-emerald-500 card-hover animate-slideUp delay-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs lg:text-sm text-gray-500">Selesai</p>
                <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $selesai }}</p>
            </div>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-emerald-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-l-4 border-violet-500 card-hover animate-slideUp delay-400 col-span-2 sm:col-span-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs lg:text-sm text-gray-500">Total Siswa</p>
                <p class="text-xl lg:text-2xl font-bold text-gray-800">{{ $totalSiswa }}</p>
            </div>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-violet-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 mb-6 animate-slideUp delay-200">
    <h3 class="font-semibold text-gray-800 mb-4">Filter Aspirasi</h3>
    <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 lg:gap-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                class="w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Bulan</label>
            <select name="bulan" class="w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                <option value="">Semua Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Siswa</label>
            <select name="siswa_id" class="w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                <option value="">Semua Siswa</option>
                @foreach($siswaList as $s)
                    <option value="{{ $s->id }}" {{ request('siswa_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->username }} ({{ $s->nis }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Jenis Pelaku</label>
            <select name="pelaku_type" class="w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                <option value="">Semua Jenis</option>
                @foreach($pelakuTypes as $type)
                    <option value="{{ $type }}" {{ request('pelaku_type') == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                <option value="">Semua Status</option>
                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="sm:col-span-2 lg:col-span-5 flex gap-2">
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 font-medium">Reset</a>
        </div>
    </form>
</div>

<!-- Aspirasi Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden animate-slideUp delay-300">
    <div class="px-4 lg:px-6 py-4 border-b flex items-center justify-between">
        <h3 class="font-semibold text-gray-800">Daftar Aspirasi</h3>
        <a href="{{ route('admin.aspirasi.index') }}" class="text-red-600 text-sm hover:text-red-700 font-medium transition-colors duration-200 hover:underline">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Siswa</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Jenis Pelaku</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Keterangan</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Tanggal</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($aspirasi as $index => $item)
                    <tr class="row-hover">
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-900 font-medium">{{ $aspirasi->firstItem() + $index }}</td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $item->inputAspirasi->siswa->username ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->inputAspirasi->siswa->nis ?? '-' }}</div>
                        </td>
                        <td class="px-4 lg:px-6 py-4 hidden sm:table-cell">
                            <span class="px-2.5 py-1 text-xs rounded-full bg-gray-100 text-gray-700 font-medium">
                                {{ ucfirst($item->inputAspirasi->pelaku->type ?? '-') }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-600 max-w-xs truncate hidden md:table-cell">
                            {{ Str::limit($item->inputAspirasi->keterangan ?? '-', 50) }}
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            @php
                                $colors = [
                                    'Menunggu' => 'bg-amber-100 text-amber-800',
                                    'Proses' => 'bg-orange-100 text-orange-800',
                                    'Selesai' => 'bg-emerald-100 text-emerald-800'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs rounded-full font-medium {{ $colors[$item->status] ?? 'bg-gray-100' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-500 hidden lg:table-cell">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <a href="{{ route('admin.aspirasi.show', $item->id) }}" 
                                class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data aspirasi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t">
        @if($aspirasi->hasPages())
            {{ $aspirasi->links() }}
        @else
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-700 leading-5">
                    Menampilkan <span class="font-medium">{{ $aspirasi->firstItem() ?? 0 }}</span>
                    sampai <span class="font-medium">{{ $aspirasi->lastItem() ?? 0 }}</span>
                    dari <span class="font-medium">{{ $aspirasi->total() }}</span> data
                </p>
            </div>
        @endif
    </div>
</div>
@endsection