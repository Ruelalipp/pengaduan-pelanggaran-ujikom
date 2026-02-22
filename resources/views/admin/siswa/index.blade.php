@extends('layouts.admin')

@section('page-title', 'Daftar Akun Siswa')

@section('page-content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 animate-slideUp">
    <h2 class="text-lg font-bold text-gray-800">Manajemen Akun Siswa</h2>
    <a href="{{ route('admin.siswa.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl hover:from-red-700 hover:to-rose-700 transition-all duration-300 btn-hover font-medium flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Siswa
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden animate-slideUp delay-100">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">NIS</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Username</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Kelas</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($siswa as $index => $item)
                    <tr class="row-hover">
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-900 font-medium">{{ $siswa->firstItem() + $index }}</td>
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-900">{{ $item->nis }}</td>
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-900 font-semibold">{{ $item->username }}</td>
                        <td class="px-4 lg:px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $item->kelas }}</td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.siswa.edit', $item->id) }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium transition-colors duration-200 hover:underline">Edit</a>
                                <form action="{{ route('admin.siswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data siswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($siswa->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $siswa->links() }}
        </div>
    @endif
</div>
@endsection
