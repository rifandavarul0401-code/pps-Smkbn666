<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::orderBy('created_at', 'desc')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:guru,nip',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'bidang_studi' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email',
            'no_telp' => 'nullable|numeric|digits_between:10,15',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Guru::create($request->all());
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|string|unique:guru,nip,' . $id . ',guru_id',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'bidang_studi' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $id . ',guru_id',
            'no_telp' => 'nullable|numeric|digits_between:10,15',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diupdate!');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}