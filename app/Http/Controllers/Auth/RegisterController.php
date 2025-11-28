<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('login-register.register');
    }

    public function register(Request $request)
    {
        // Validasi input - TIDAK ADA validasi level karena otomatis
        $request->validate([
            'username' => 'required|unique:users,username|min:3',
            'password' => 'required|min:6|confirmed',
            'nama_lengkap' => 'required',
        ]);

        // Buat user baru dengan level OTOMATIS "siswa"
        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama_lengkap' => $request->nama_lengkap,
            'level' => 'siswa', 
            'is_active' => true,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}