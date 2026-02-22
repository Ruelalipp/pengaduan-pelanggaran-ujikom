<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Try to find admin first - use DB query to get password directly
        $admin = DB::table('admin')
                    ->where('username', $request->username)
                    ->orWhere('id', $request->username)
                    ->first();

        if ($admin && $request->password === $admin->password) {
            // Store admin model in session
            $adminModel = Admin::find($admin->id);
            session(['admin' => $adminModel]);
            session(['role' => 'admin']);
            return redirect('/admin/dashboard');
        }

        // Try to find siswa - use DB query to get password directly
        $siswa = DB::table('siswa')
                    ->where('username', $request->username)
                    ->orWhere('nis', $request->username)
                    ->first();

        if ($siswa && $request->password === $siswa->password) {
            // Store siswa model in session
            $siswaModel = Siswa::find($siswa->id);
            session(['siswa' => $siswaModel]);
            session(['role' => 'siswa']);
            return redirect('/siswa/dashboard');
        }

        return back()->with('error', 'Username/NIS atau password salah!');
    }

    public function logout()
    {
        $role = session('role');
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
