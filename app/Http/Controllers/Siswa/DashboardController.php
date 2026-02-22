<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = session('siswa');
        
        // Get statistics for this siswa
        $totalAspirasi = InputAspirasi::where('siswa_id', $siswa->id)->count();
        
        $menunggu = Aspirasi::whereHas('inputAspirasi', function($q) use ($siswa) {
            $q->where('siswa_id', $siswa->id);
        })->where('status', 'Menunggu')->count();
        
        $proses = Aspirasi::whereHas('inputAspirasi', function($q) use ($siswa) {
            $q->where('siswa_id', $siswa->id);
        })->where('status', 'Proses')->count();
        
        $selesai = Aspirasi::whereHas('inputAspirasi', function($q) use ($siswa) {
            $q->where('siswa_id', $siswa->id);
        })->where('status', 'Selesai')->count();

        // Get recent aspirasi
        $recentAspirasi = Aspirasi::with(['inputAspirasi.pelaku', 'admin'])
            ->whereHas('inputAspirasi', function($q) use ($siswa) {
                $q->where('siswa_id', $siswa->id);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'totalAspirasi',
            'menunggu',
            'proses',
            'selesai',
            'recentAspirasi'
        ));
    }
}
