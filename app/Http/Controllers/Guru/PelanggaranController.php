<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Siswa\Siswa;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->where('guru_pencatat', auth()->id())
            ->latest()->paginate(10);
        return view('guru.pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        return view('guru.pelanggaran.create', compact('siswa', 'jenisPelanggaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,jenis_pelanggaran_id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        try {
            $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
            
            Pelanggaran::create([
                'siswa_id' => $request->siswa_id,
                'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
                'tanggal' => $request->tanggal,
                'poin' => $jenisPelanggaran->poin,
                'keterangan' => $request->keterangan,
                'status_verifikasi' => 'pending',
                'guru_pencatat' => auth()->id(),
                'tahun_ajaran_id' => 1
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan pelanggaran: ' . $e->getMessage());
        }

        return redirect()->route('guru.dashboard')->with('success', 'Pelanggaran berhasil dilaporkan');
    }
}