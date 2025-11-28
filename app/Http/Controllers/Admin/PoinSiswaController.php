<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa\Siswa;
use App\Models\Siswa\PoinSiswa;

class PoinSiswaController extends Controller
{
    public function index()
    {
        $poinSiswa = Siswa::with(['poinSiswa', 'kelas'])
            ->where('status', 'aktif')
            ->paginate(20);

        return view('admin.poin-siswa.index', compact('poinSiswa'));
    }

    public function detail($siswa_id)
    {
        $siswa = Siswa::with(['poinSiswa', 'kelas', 'pelanggaran.jenisPelanggaran', 'prestasi.jenisPrestasi'])
            ->findOrFail($siswa_id);

        $pelanggaran = $siswa->pelanggaran;
        $prestasi = $siswa->prestasi;
        
        $totalPelanggaran = $pelanggaran->sum('poin');
        $totalPrestasi = $prestasi->sum('poin');
        $totalAkhir = 100 - $totalPelanggaran + $totalPrestasi;

        return view('admin.poin-siswa.detail', compact('siswa', 'pelanggaran', 'prestasi', 'totalPelanggaran', 'totalPrestasi', 'totalAkhir'));
    }
}