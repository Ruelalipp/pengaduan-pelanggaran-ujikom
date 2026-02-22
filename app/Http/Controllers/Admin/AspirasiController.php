<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    /**
     * Display a listing of aspirasi
     */
    public function index(Request $request)
    {
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.pelaku', 'admin'])
            ->where('is_archived', false)
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('inputAspirasi', function($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('siswa', function($sq) use ($search) {
                      $sq->where('username', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%");
                  });
            });
        }

        $aspirasi = $query->paginate(10);

        return view('admin.aspirasi.index', compact('aspirasi'));
    }

    /**
     * Display the specified aspirasi
     */
    public function show($id)
    {
        $aspirasi = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.pelaku', 'admin'])
            ->findOrFail($id);

        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    /**
     * Update aspirasi status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'admin_id' => session('admin')->id
        ]);

        return back()->with('success', 'Status berhasil diupdate!');
    }

    /**
     * Update aspirasi feedback
     */
    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        
        $data = [
            'feedback' => $request->feedback,
            'admin_id' => session('admin')->id
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/feedback'), $filename);
            $data['gambar'] = 'uploads/feedback/' . $filename;
        }

        $aspirasi->update($data);

        return back()->with('success', 'Feedback berhasil disimpan!');
    }

    /**
     * Display histori aspirasi
     */
    /**
     * Display histori aspirasi (Selesai & Unarchived)
     */
    public function histori(Request $request)
    {
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.pelaku', 'admin'])
            ->where('status', 'Selesai')
            ->where('is_archived', false) // Only show unarchived
            ->latest();
        
        if ($request->filled('bulan')) {
            $query->whereMonth('updated_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('updated_at', $request->tahun);
        }

        $aspirasi = $query->paginate(10);

        return view('admin.aspirasi.histori', compact('aspirasi'));
    }

    /**
     * Display arsip aspirasi (Selesai & Archived)
     */
    public function arsip(Request $request)
    {
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.pelaku', 'admin'])
            ->where('status', 'Selesai')
            ->where('is_archived', true) // Only show archived
            ->latest();
        
        if ($request->filled('bulan')) {
            $query->whereMonth('updated_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('updated_at', $request->tahun);
        }

        $aspirasi = $query->paginate(10);

        return view('admin.aspirasi.arsip', compact('aspirasi'));
    }

    /**
     * Archive the specified aspirasi
     */
    public function archive($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        $aspirasi->update([
            'is_archived' => true
        ]);

        return back()->with('success', 'Aspirasi berhasil diarsipkan!');
    }
}
