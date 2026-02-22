<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginSiswaController extends Controller
{
    public function form()
    {
        return view('auth.login_siswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $siswa = Siswa::where('username', $request->username)
                      ->orWhere('nis', $request->username)
                      ->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {
            session(['siswa' => $siswa]);
            return redirect('/siswa/dashboard');
        }

        return back()->with('error', 'Username/NIS atau password salah!');
    }

    public function logout()
    {
        session()->forget('siswa');
        return redirect('/login-siswa')->with('success', 'Berhasil logout!');
    }
}
