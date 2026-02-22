@extends('layouts.admin')

@section('page-title', 'Jenis Pelaku')

@section('page-content')
<div class="max-w-2xl">
    <!-- Add New -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 animate-scaleIn">
        <h3 class="font-bold text-gray-800 mb-4">Tambah Jenis Pelaku</h3>
        <form method="POST" action="{{ route('admin.pelaku.store') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <select name="type" required class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 hover:border-gray-300">
                <option value="">Pilih Jenis</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="staff">Staff</option>
            </select>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium">Tambah</button>
        </form>
        @error('type')<p class="text-red-500 text-sm mt-2">{{ $message }}</p>@enderror
    </div>

    <!-- List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-slideUp delay-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Laporan</th>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pelaku as $index => $item)
                        <tr class="row-hover">
                            <td class="px-4 lg:px-6 py-4 text-sm text-gray-900 font-medium">{{ $index + 1 }}</td>
                            <td class="px-4 lg:px-6 py-4 font-semibold text-gray-900">{{ ucfirst($item->type) }}</td>
                            <td class="px-4 lg:px-6 py-4 text-sm text-gray-500">{{ $item->input_aspirasi_count }} laporan</td>
                            <td class="px-4 lg:px-6 py-4">
                                <form method="POST" action="{{ route('admin.pelaku.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Hapus jenis pelaku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data jenis pelaku</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
