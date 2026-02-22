@extends('layouts.admin')

@section('page-title', 'Arsip Aspirasi')

@section('page-content')
<!-- Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6 animate-slideUp">
    <form method="GET" class="flex flex-col sm:flex-row flex-wrap gap-3">
        <select name="bulan" class="px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
            <option value="">Semua Bulan</option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
            @endfor
        </select>
        <select name="tahun" class="px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
            <option value="">Semua Tahun</option>
            @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Filter</button>
        <a href="{{ route('admin.aspirasi.arsip') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 text-center font-medium">Reset</a>
    </form>
</div>

<!-- Arsip Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden animate-slideUp delay-100">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Siswa</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Jenis Pelaku</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Keterangan</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diarsipkan Pada</th>
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
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-500">
                            {{ $item->updated_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <a href="{{ route('admin.aspirasi.show', ['id' => $item->id, 'readonly' => 1]) }}" 
                                class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200 hover:underline">
                                Lihat Pengaduan
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada aspirasi diarsipkan</td>
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
