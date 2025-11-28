<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Core\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuruController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'pelanggaran_hari_ini' => Pelanggaran::whereDate('tanggal', Carbon::today())->count(),
            'prestasi_hari_ini' => Prestasi::whereDate('created_at', Carbon::today())->count()
        ];

        $recentPelanggaran = Pelanggaran::with(['jenisPelanggaran', 'siswa', 'tahunAjaran'])
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $recentPrestasi = Prestasi::with(['jenisPrestasi', 'siswa', 'tahunAjaran'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('guru.dashboard', compact('stats', 'recentPelanggaran', 'recentPrestasi'));
    }

    public function daftarSiswa(Request $request)
    {
        $query = Siswa::with(['kelas', 'poinSiswa'])->orderBy('nama_siswa', 'asc');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->has('kelas') && $request->kelas) {
            $query->where('kelas_id', $request->kelas);
        }
        
        $siswa = $query->paginate(10);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        
        return view('guru.daftar-siswa', compact('siswa', 'kelas'));
    }

    public function riwayatInput()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->where('guru_pencatat', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
            
        $prestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->where('guru_pencatat', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('guru.riwayat-input', compact('pelanggaran', 'prestasi'));
    }

    public function laporanKelas(Request $request)
    {
        $kelas = Kelas::with(['siswa'])->get();
        $selectedKelas = null;
        $data = [];
        
        if ($request->has('kelas_id') && $request->kelas_id) {
            $selectedKelas = Kelas::with(['siswa.pelanggaran', 'siswa.prestasi'])
                ->find($request->kelas_id);
                
            if ($selectedKelas) {
                foreach ($selectedKelas->siswa as $siswa) {
                    $data[] = [
                        'siswa' => $siswa,
                        'total_pelanggaran' => $siswa->pelanggaran->count(),
                        'total_prestasi' => $siswa->prestasi->count(),
                        'poin' => $siswa->total_poin
                    ];
                }
            }
        }
        
        return view('guru.laporan-kelas', compact('kelas', 'selectedKelas', 'data'));
    }
}
