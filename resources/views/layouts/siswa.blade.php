@extends('layouts.app')

@section('title', 'Siswa - ' . ($title ?? 'Dashboard'))

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Top Navigation -->
    <nav class="bg-gradient-to-r from-red-700 to-rose-800 text-white shadow-lg relative z-40">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20 transition-transform duration-300 hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold tracking-tight">Sistem Pengaduan</h1>
                        <p class="text-xs text-red-200/70">Portal Siswa</p>
                    </div>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('siswa.dashboard') }}" 
                        class="px-4 py-2 rounded-xl transition-all duration-300 text-sm font-medium {{ request()->routeIs('siswa.dashboard') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10 hover:scale-105' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('siswa.aspirasi.index') }}" 
                        class="px-4 py-2 rounded-xl transition-all duration-300 text-sm font-medium {{ request()->routeIs('siswa.aspirasi.index') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10 hover:scale-105' }}">
                        Aspirasi Saya
                    </a>
                    <a href="{{ route('siswa.aspirasi.create') }}" 
                        class="px-4 py-2 rounded-xl transition-all duration-300 text-sm font-medium {{ request()->routeIs('siswa.aspirasi.create') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10 hover:scale-105' }}">
                        Buat Laporan
                    </a>
                    <a href="{{ route('siswa.aspirasi.histori') }}" 
                        class="px-4 py-2 rounded-xl transition-all duration-300 text-sm font-medium {{ request()->routeIs('siswa.aspirasi.histori') ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10 hover:scale-105' }}">
                        Histori
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-sm">{{ session('siswa')->username ?? 'Siswa' }}</p>
                        <p class="text-xs text-red-200/70">{{ session('siswa')->kelas ?? '-' }}</p>
                    </div>
                    <a href="{{ route('logout') }}" 
                        class="p-2 hover:bg-white/10 rounded-xl transition-all duration-300 hover:scale-110 group" title="Logout">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden border-t border-red-500/30 px-4 py-2 flex gap-2 overflow-x-auto">
            <a href="{{ route('siswa.dashboard') }}" 
                class="px-3 py-1.5 rounded-xl text-sm whitespace-nowrap font-medium transition-all duration-300 {{ request()->routeIs('siswa.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                Dashboard
            </a>
            <a href="{{ route('siswa.aspirasi.index') }}" 
                class="px-3 py-1.5 rounded-xl text-sm whitespace-nowrap font-medium transition-all duration-300 {{ request()->routeIs('siswa.aspirasi.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                Aspirasi
            </a>
            <a href="{{ route('siswa.aspirasi.create') }}" 
                class="px-3 py-1.5 rounded-xl text-sm whitespace-nowrap font-medium transition-all duration-300 {{ request()->routeIs('siswa.aspirasi.create') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                Lapor
            </a>
            <a href="{{ route('siswa.aspirasi.histori') }}" 
                class="px-3 py-1.5 rounded-xl text-sm whitespace-nowrap font-medium transition-all duration-300 {{ request()->routeIs('siswa.aspirasi.histori') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                Histori
            </a>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-6 animate-fadeIn">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl animate-slideUp flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl animate-slideUp flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('page-content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto py-4">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} Sistem Pengaduan Pelanggaran - Portal Siswa
        </div>
    </footer>
</div>
@endsection
