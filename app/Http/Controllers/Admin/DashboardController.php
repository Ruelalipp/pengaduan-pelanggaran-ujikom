<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Pelaku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get statistics
        $totalAspirasi = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();
        $totalSiswa = Siswa::count();

        // Get recent aspirasi with filters
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.pelaku', 'admin'])
            ->where('is_archived', false)
            ->latest();

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter by month
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter by siswa
        if ($request->filled('siswa_id')) {
            $query->whereHas('inputAspirasi', function($q) use ($request) {
                $q->where('siswa_id', $request->siswa_id);
            });
        }

        // Filter by pelaku type
        if ($request->filled('pelaku_type')) {
            $query->whereHas('inputAspirasi.pelaku', function($q) use ($request) {
                $q->where('type', $request->pelaku_type);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasi = $query->paginate(5);
        $siswaList = Siswa::all();
        $pelakuTypes = ['siswa', 'guru', 'staff'];

        return view('admin.dashboard', compact(
            'totalAspirasi', 
            'menunggu', 
            'proses', 
            'selesai',
            'totalSiswa',
            'aspirasi',
            'siswaList',
            'pelakuTypes'
        ));
    }
}
