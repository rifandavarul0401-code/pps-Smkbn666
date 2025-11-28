<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Siswa\Siswa;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function getRouteKeyName()
    {
        return 'pelanggaran_id';
    }
    
    public function index()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])->latest()->paginate(20);
        return view('admin.pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        return view('admin.pelanggaran.create', compact('siswa', 'jenisPelanggaran', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,jenis_pelanggaran_id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        Pelanggaran::create([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'tanggal' => $request->tanggal,
            'poin' => $jenisPelanggaran->poin,
            'keterangan' => $request->keterangan,
            'status_verifikasi' => 'pending',
            'guru_pencatat' => auth()->user()->user_id,
            'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id ?? 1
        ]);

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan');
    }

    public function show(Pelanggaran $pelanggaran)
    {
        $pelanggaran->load(['siswa', 'jenisPelanggaran', 'guruPencatat']);
        return view('admin.pelanggaran.show', compact('pelanggaran'));
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        return view('admin.pelanggaran.edit', compact('pelanggaran', 'siswa', 'jenisPelanggaran'));
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,jenis_pelanggaran_id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
        
        $pelanggaran->update([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'tanggal' => $request->tanggal,
            'poin' => $jenisPelanggaran->poin,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran berhasil diupdate');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran berhasil dihapus');
    }

    public function verify(Pelanggaran $pelanggaran)
    {
        $pelanggaran->update(['status_verifikasi' => 'verified', 'guru_verifikator' => auth()->user()->user_id]);
        return redirect()->back()->with('success', 'Pelanggaran berhasil diverifikasi');
    }
}