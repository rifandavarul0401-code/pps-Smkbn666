<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Guru\Guru;
use App\Models\Core\Kelas;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }
        
        // Ambil kelas yang diampu wali kelas
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        if ($kelas) {
            $siswaKelas = Siswa::where('kelas_id', $kelas->kelas_id)->get();
            $siswaIds = $siswaKelas->pluck('siswa_id');
            
            $total_siswa = $siswaKelas->count();
            $total_pelanggaran = Pelanggaran::whereIn('siswa_id', $siswaIds)->count();
            $total_prestasi = Prestasi::whereIn('siswa_id', $siswaIds)->count();
            
            $recentPelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
                ->whereIn('siswa_id', $siswaIds)
                ->latest()
                ->take(5)
                ->get();
            $recentPrestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
                ->whereIn('siswa_id', $siswaIds)
                ->latest()
                ->take(5)
                ->get();
        } else {
            $total_siswa = 0;
            $total_pelanggaran = 0;
            $total_prestasi = 0;
            $recentPelanggaran = collect();
            $recentPrestasi = collect();
            $kelas = null;
        }
        
        return view('walikelas.dashboard', compact('total_siswa', 'total_pelanggaran', 'total_prestasi', 'recentPelanggaran', 'recentPrestasi', 'kelas'));
    }
    
    public function createPelanggaran()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        if (!$kelas) {
            return redirect()->route('walikelas.dashboard')->with('error', 'Anda belum memiliki kelas yang diampu');
        }
        
        $siswa = Siswa::where('kelas_id', $kelas->kelas_id)->get();
        $jenisPelanggaran = JenisPelanggaran::all();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        return view('walikelas.pelanggaran.create', compact('siswa', 'jenisPelanggaran', 'tahunAjaran', 'kelas'));
    }
    
    public function storePelanggaran(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,jenis_pelanggaran_id',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date'
        ]);
        
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();
        
        if (!$tahunAjaran) {
            return redirect()->back()->with('error', 'Tidak ada tahun ajaran aktif');
        }
        
        Pelanggaran::create([
            'siswa_id' => $request->siswa_id,
            'guru_pencatat' => auth()->id(),
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id,
            'poin' => $jenisPelanggaran->poin,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'status_verifikasi' => 'pending'
        ]);
        
        return redirect()->route('walikelas.dashboard')->with('success', 'Pelanggaran berhasil dicatat');
    }
    
    public function dataWaliKelas()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        $pelanggaran = collect();
        $prestasi = collect();
        
        if ($kelas) {
            $siswaIds = Siswa::where('kelas_id', $kelas->kelas_id)->pluck('siswa_id');
            $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
                ->whereIn('siswa_id', $siswaIds)
                ->where('guru_pencatat', $user->user_id)
                ->latest()
                ->get();
            $prestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
                ->whereIn('siswa_id', $siswaIds)
                ->where('created_by', $user->user_id)
                ->latest()
                ->get();
        }
        
        return view('walikelas.data-walikelas', compact('pelanggaran', 'prestasi', 'kelas', 'guru'));
    }
    
    public function siswaKelas()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        $siswa = collect();
        if ($kelas) {
            $siswa = Siswa::with(['poinSiswa', 'pelanggaran', 'prestasi'])
                ->where('kelas_id', $kelas->kelas_id)
                ->get();
        }
        
        return view('walikelas.siswa-kelas', compact('siswa', 'kelas'));
    }
    
    public function monitoring()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        $data = [];
        if ($kelas) {
            $siswa = Siswa::with(['poinSiswa', 'pelanggaran.jenisPelanggaran', 'prestasi.jenisPrestasi'])
                ->where('kelas_id', $kelas->kelas_id)
                ->get();
            
            foreach ($siswa as $s) {
                $data[] = [
                    'siswa' => $s,
                    'total_pelanggaran' => $s->pelanggaran->count(),
                    'total_prestasi' => $s->prestasi->count(),
                    'poin_saat_ini' => $s->total_poin,
                    'pelanggaran_bulan_ini' => $s->pelanggaran()->whereMonth('tanggal', now()->month)->count(),
                    'prestasi_bulan_ini' => $s->prestasi()->whereMonth('tanggal', now()->month)->count()
                ];
            }
        }
        
        return view('walikelas.monitoring', compact('data', 'kelas'));
    }
    
    public function exportLaporan()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        return view('walikelas.export-laporan', compact('kelas'));
    }
    
    public function exportPelanggaranPdf()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan');
        }
        
        $siswaIds = Siswa::where('kelas_id', $kelas->kelas_id)->pluck('siswa_id');
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'guruPencatat'])
            ->whereIn('siswa_id', $siswaIds)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        $pdf = Pdf::loadView('walikelas.pdf.pelanggaran', compact('pelanggaran', 'kelas', 'guru'));
        return $pdf->download('laporan-pelanggaran-' . $kelas->nama_kelas . '.pdf');
    }
    
    public function exportPrestasiPdf()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan');
        }
        
        $siswaIds = Siswa::where('kelas_id', $kelas->kelas_id)->pluck('siswa_id');
        $prestasi = Prestasi::with(['siswa', 'jenisPrestasi', 'guruPencatat'])
            ->whereIn('siswa_id', $siswaIds)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        $pdf = Pdf::loadView('walikelas.pdf.prestasi', compact('prestasi', 'kelas', 'guru'));
        return $pdf->download('laporan-prestasi-' . $kelas->nama_kelas . '.pdf');
    }
    
    public function exportMonitoringPdf()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelas = Kelas::where('wali_kelas_id', $guru->guru_id)->first();
        
        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan');
        }
        
        $siswa = Siswa::with(['poinSiswa', 'pelanggaran.jenisPelanggaran', 'prestasi.jenisPrestasi'])
            ->where('kelas_id', $kelas->kelas_id)
            ->get();
        
        $data = [];
        foreach ($siswa as $s) {
            $data[] = [
                'siswa' => $s,
                'total_pelanggaran' => $s->pelanggaran->count(),
                'total_prestasi' => $s->prestasi->count(),
                'poin_saat_ini' => $s->total_poin,
                'pelanggaran_bulan_ini' => $s->pelanggaran()->whereMonth('tanggal', now()->month)->count(),
                'prestasi_bulan_ini' => $s->prestasi()->whereMonth('tanggal', now()->month)->count()
            ];
        }
        
        $pdf = Pdf::loadView('walikelas.pdf.monitoring', compact('data', 'kelas', 'guru'));
        return $pdf->download('laporan-monitoring-' . $kelas->nama_kelas . '.pdf');
    }
}