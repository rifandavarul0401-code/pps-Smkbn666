<?php

namespace App\Http\Controllers\kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Prestasi\Prestasi;
use App\Models\Prestasi\JenisPrestasi;
use App\Models\Siswa\Siswa;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function create()
    {
        $siswa = Siswa::all();
        $jenisPrestasi = JenisPrestasi::orderBy('nama_prestasi', 'asc')->get();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        return view('kesiswaan.prestasi.create', compact('siswa', 'jenisPrestasi', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_prestasi_id' => 'required|exists:jenis_prestasi,jenis_prestasi_id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $jenisPrestasi = JenisPrestasi::find($request->jenis_prestasi_id);
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        if (!$tahunAjaran) {
            return redirect()->back()->with('error', 'Tidak ada tahun ajaran aktif');
        }
        
        Prestasi::create([
            'siswa_id' => $request->siswa_id,
            'jenis_prestasi_id' => $request->jenis_prestasi_id,
            'tanggal_prestasi' => $request->tanggal,
            'poin' => $jenisPrestasi->poin,
            'keterangan' => $request->keterangan,
            'status_verifikasi' => 'pending',
            'created_by' => auth()->id(),
            'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id
        ]);

        return redirect()->route('kesiswaan.dashboard')->with('success', 'Prestasi berhasil ditambahkan');
    }
}
