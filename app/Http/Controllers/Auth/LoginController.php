<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function showLogin()
{
    return view('login-register.login');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun tidak aktif.']);
            }

            $user->update(['last_login' => now()]);
            $request->session()->regenerate();
            
            return match($user->level) {
                'admin' => redirect()->route('admin.dashboard'),
                'kesiswaan' => redirect()->route('kesiswaan.dashboard'),
                'guru' => redirect()->route('guru.dashboard'),
                'kepsek' => redirect()->route('kepsek.dashboard'),
                'bk' => redirect()->route('bk.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                'ortu' => redirect()->route('ortu.dashboard'),
                'wali_kelas' => redirect()->route('walikelas.dashboard'),
            };
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}