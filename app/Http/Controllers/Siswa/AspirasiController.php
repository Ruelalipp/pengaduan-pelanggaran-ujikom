<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Pelaku;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    /**
     * Display a listing of siswa's aspirasi
     */
    public function index(Request $request)
    {
        $siswa = session('siswa');
        
        $query = Aspirasi::with(['inputAspirasi.pelaku', 'admin'])
            ->whereHas('inputAspirasi', function($q) use ($siswa) {
                $q->where('siswa_id', $siswa->id);
            })
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasi = $query->paginate(10);

        return view('siswa.aspirasi.index', compact('aspirasi'));
    }

    /**
     * Show the form for creating a new aspirasi
     */
    public function create()
    {
        $pelaku = Pelaku::all();
        return view('siswa.aspirasi.create', compact('pelaku'));
    }

    /**
     * Store a newly created aspirasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelaku_id' => 'required|exists:pelaku,id',
            'keterangan' => 'required|string|min:10',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $siswa = session('siswa');
        
        // Handle image upload
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aspirasi'), $filename);
            $gambarPath = 'uploads/aspirasi/' . $filename;
        }

        // Create input aspirasi
        $inputAspirasi = InputAspirasi::create([
            'siswa_id' => $siswa->id,
            'pelaku_id' => $request->pelaku_id,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath
        ]);

        // Create aspirasi record with default status
        Aspirasi::create([
            'input_aspirasi_id' => $inputAspirasi->id,
            'admin_id' => 1, // Will be updated by admin
            'status' => 'Menunggu'
        ]);

        return redirect()->route('siswa.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Display the specified aspirasi
     */
    public function show($id)
    {
        $siswa = session('siswa');
        
        $aspirasi = Aspirasi::with(['inputAspirasi.pelaku', 'admin'])
            ->whereHas('inputAspirasi', function($q) use ($siswa) {
                $q->where('siswa_id', $siswa->id);
            })
            ->findOrFail($id);

        return view('siswa.aspirasi.show', compact('aspirasi'));
    }

    /**
     * Display histori aspirasi
     */
    public function histori()
    {
        $siswa = session('siswa');
        
        $aspirasi = Aspirasi::with(['inputAspirasi.pelaku', 'admin'])
            ->whereHas('inputAspirasi', function($q) use ($siswa) {
                $q->where('siswa_id', $siswa->id);
            })
            ->where('status', 'Selesai')
            ->latest()
            ->paginate(10);

        return view('siswa.aspirasi.histori', compact('aspirasi'));
    }
}
