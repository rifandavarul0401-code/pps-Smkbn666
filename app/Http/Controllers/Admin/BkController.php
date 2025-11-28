<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bk\BimbinganKonseling;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;
use Illuminate\Http\Request;

class BkController extends Controller
{
    public function index()
    {
        $bimbingan = BimbinganKonseling::with(['siswa', 'guruKonselor'])->orderBy('created_at', 'desc')->get();
        return view('admin.bk.index', compact('bimbingan'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $guru = Guru::where('bidang_studi', 'Bimbingan Konseling')->get();
        return view('admin.bk.create', compact('siswa', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'guru_konselor_id' => 'required|exists:guru,guru_id',
            'jenis_layanan' => 'required|in:konseling_individu,konseling_kelompok,bimbingan_klasikal,konsultasi',
            'topik' => 'required|string|max:255',
            'keluhan_masalah' => 'required|string',
            'tindakan_solusi' => 'required|string',
            'status' => 'required|in:proses,selesai,tindak_lanjut',
            'tanggal_konseling' => 'required|date',
            'tanggal_tindak_lanjut' => 'nullable|date',
            'hasil_evaluasi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['tahun_ajaran_id'] = 1; // Default tahun ajaran aktif
        BimbinganKonseling::create($data);
        return redirect()->route('admin.bk.index')->with('success', 'Data bimbingan konseling berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bimbingan = BimbinganKonseling::findOrFail($id);
        $siswa = Siswa::all();
        $guru = Guru::where('bidang_studi', 'Bimbingan Konseling')->get();
        return view('admin.bk.edit', compact('bimbingan', 'siswa', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'guru_konselor_id' => 'required|exists:guru,guru_id',
            'jenis_layanan' => 'required|in:konseling_individu,konseling_kelompok,bimbingan_klasikal,konsultasi',
            'topik' => 'required|string|max:255',
            'keluhan_masalah' => 'required|string',
            'tindakan_solusi' => 'required|string',
            'status' => 'required|in:proses,selesai,tindak_lanjut',
            'tanggal_konseling' => 'required|date',
            'tanggal_tindak_lanjut' => 'nullable|date',
            'hasil_evaluasi' => 'nullable|string',
        ]);

        $bimbingan = BimbinganKonseling::findOrFail($id);
        $data = $request->all();
        $data['tahun_ajaran_id'] = 1; // Default tahun ajaran aktif
        $bimbingan->update($data);
        return redirect()->route('admin.bk.index')->with('success', 'Data bimbingan konseling berhasil diupdate!');
    }

    public function destroy($id)
    {
        $bimbingan = BimbinganKonseling::findOrFail($id);
        $bimbingan->delete();
        return redirect()->route('admin.bk.index')->with('success', 'Data bimbingan konseling berhasil dihapus!');
    }
}