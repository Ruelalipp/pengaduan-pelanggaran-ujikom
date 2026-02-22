<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'username' => 'required|unique:siswa,username',
            'kelas' => 'required',
            'password' => 'required|min:6',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'username' => $request->username,
            'kelas' => $request->kelas,
            'password' => $request->password, // Storing as plain text per request
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Akun siswa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id,
            'username' => 'required|unique:siswa,username,' . $id,
            'kelas' => 'required',
            'password' => 'nullable|min:6', // Optional password update
        ]);

        $data = [
            'nis' => $request->nis,
            'username' => $request->username,
            'kelas' => $request->kelas,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password; // Storing as plain text per request
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Akun siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Check if related data exists if necessary (e.g., in input_aspirasi)
        if ($siswa->inputAspirasi()->exists()) {
             return back()->with('error', 'Tidak dapat menghapus siswa ini karena memiliki data aspirasi!');
        }

        $siswa->delete();

        return back()->with('success', 'Akun siswa berhasil dihapus!');
    }
}
