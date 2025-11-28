<?php

namespace App\Http\Controllers\kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Siswa\Siswa;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function create()
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::orderBy('nama_pelanggaran', 'asc')->get();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        return view('kesiswaan.pelanggaran.create', compact('siswa', 'jenisPelanggaran', 'tahunAjaran'));
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
        
        if (!$tahunAjaran) {
            return redirect()->back()->with('error', 'Tidak ada tahun ajaran aktif');
        }
        
        Pelanggaran::create([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'tanggal' => $request->tanggal,
            'poin' => $jenisPelanggaran->poin,
            'keterangan' => $request->keterangan,
            'status_verifikasi' => 'pending',
            'guru_pencatat' => auth()->id(),
            'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id
        ]);

        return redirect()->route('kesiswaan.dashboard')->with('success', 'Pelanggaran berhasil ditambahkan');
    }
}
