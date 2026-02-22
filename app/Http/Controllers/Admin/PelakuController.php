<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelaku;
use Illuminate\Http\Request;

class PelakuController extends Controller
{
    /**
     * Display a listing of pelaku
     */
    public function index()
    {
        $pelaku = Pelaku::withCount('inputAspirasi')->get();
        return view('admin.pelaku.index', compact('pelaku'));
    }

    /**
     * Store a newly created pelaku
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:siswa,guru,staff|unique:pelaku,type'
        ]);

        Pelaku::create([
            'type' => $request->type
        ]);

        return back()->with('success', 'Jenis pelaku berhasil ditambahkan!');
    }

    /**
     * Remove the specified pelaku
     */
    public function destroy($id)
    {
        $pelaku = Pelaku::findOrFail($id);
        
        if ($pelaku->inputAspirasi()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus, masih ada aspirasi terkait!');
        }

        $pelaku->delete();

        return back()->with('success', 'Jenis pelaku berhasil dihapus!');
    }
}
