<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Prestasi\Prestasi;
use App\Models\Prestasi\JenisPrestasi;
use App\Models\Siswa\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->where('guru_pencatat', auth()->id())
            ->latest()->paginate(10);
        return view('guru.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $jenisPrestasi = JenisPrestasi::all();
        return view('guru.prestasi.create', compact('siswa', 'jenisPrestasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_prestasi_id' => 'required|exists:jenis_prestasi,jenis_prestasi_id',
            'tingkat' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $jenisPrestasi = JenisPrestasi::find($request->jenis_prestasi_id);
        
        try {
            Prestasi::create([
                'siswa_id' => $request->siswa_id,
                'jenis_prestasi_id' => $request->jenis_prestasi_id,
                'tingkat' => $request->tingkat,
                'poin' => $jenisPrestasi->poin,
                'keterangan' => $request->keterangan,
                'status_verifikasi' => 'pending',
                'guru_pencatat' => auth()->id(),
                'tahun_ajaran_id' => 1
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan prestasi: ' . $e->getMessage());
        }

        return redirect()->route('guru.dashboard')->with('success', 'Prestasi berhasil dilaporkan');
    }
}