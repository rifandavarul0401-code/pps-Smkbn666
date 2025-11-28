<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kesiswaan\Kesiswaan;
use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public function index()
    {
        $kesiswaan = Kesiswaan::orderBy('created_at', 'desc')->get();
        return view('admin.kesiswaan.index', compact('kesiswaan'));
    }

    public function create()
    {
        return view('admin.kesiswaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:kesiswaan,nip',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'required|email|unique:kesiswaan,email',
            'no_telepon' => 'nullable|numeric|digits_between:10,15',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
        ]);

        Kesiswaan::create($request->all());
        return redirect()->route('admin.kesiswaan.index')->with('success', 'Data kesiswaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kesiswaan = Kesiswaan::findOrFail($id);
        return view('admin.kesiswaan.edit', compact('kesiswaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|string|unique:kesiswaan,nip,' . $id . ',kesiswaan_id',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'required|email|unique:kesiswaan,email,' . $id . ',kesiswaan_id',
            'no_telepon' => 'nullable|numeric|digits_between:10,15',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
        ]);

        $kesiswaan = Kesiswaan::findOrFail($id);
        $kesiswaan->update($request->all());
        return redirect()->route('admin.kesiswaan.index')->with('success', 'Data kesiswaan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kesiswaan = Kesiswaan::findOrFail($id);
        $kesiswaan->delete();
        return redirect()->route('admin.kesiswaan.index')->with('success', 'Data kesiswaan berhasil dihapus!');
    }
}