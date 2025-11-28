<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Sanksi\Sanksi;
use App\Models\Siswa\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BkController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'pelanggaran_pending' => Pelanggaran::where('status_verifikasi', 'pending')->count(),
            'prestasi_pending' => Prestasi::where('status_verifikasi', 'pending')->count(),
            'sanksi_aktif' => Sanksi::where('status', 'aktif')->count(),
            'siswa_bermasalah' => Siswa::whereHas('poinSiswa', function($q) {
                $q->where('total_poin', '<', 50);
            })->count()
        ];
        
        $recentPelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->where('status_verifikasi', 'pending')
            ->latest()
            ->take(5)
            ->get();
            
        $recentPrestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->where('status_verifikasi', 'pending')
            ->latest()
            ->take(5)
            ->get();
        
        return view('bk.dashboard', compact('stats', 'recentPelanggaran', 'recentPrestasi'));
    }
    
    public function sanksi()
    {
        $sanksi = Sanksi::with(['siswa', 'pelanggaran.jenisPelanggaran'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('bk.sanksi.index', compact('sanksi'));
    }
    
    public function createSanksi()
    {
        $pelanggaranBelumSanksi = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->where('status_verifikasi', 'verified')
            ->whereDoesntHave('sanksi')
            ->get();
            
        return view('bk.sanksi.create', compact('pelanggaranBelumSanksi'));
    }
    
    public function storeSanksi(Request $request)
    {
        $request->validate([
            'pelanggaran_id' => 'required|exists:pelanggaran,pelanggaran_id',
            'jenis_sanksi' => 'required|string',
            'deskripsi_sanksi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai'
        ]);
        
        $pelanggaran = Pelanggaran::find($request->pelanggaran_id);
        
        Sanksi::create([
            'pelanggaran_id' => $request->pelanggaran_id,
            'jenis_sanksi' => $request->jenis_sanksi,
            'deskripsi_sanksi' => $request->deskripsi_sanksi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif'
        ]);
        
        return redirect()->route('bk.sanksi')->with('success', 'Sanksi berhasil diberikan');
    }
    
    public function monitoringSanksi()
    {
        $sanksi = Sanksi::with(['siswa', 'pelanggaran.jenisPelanggaran'])
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
            
        return view('bk.sanksi.monitoring', compact('sanksi'));
    }
    
    public function updateStatusSanksi(Request $request, $id)
    {
        $sanksi = Sanksi::findOrFail($id);
        $sanksi->update([
            'status' => $request->status
        ]);
        
        return redirect()->back()->with('success', 'Status sanksi berhasil diupdate');
    }
    
    public function konseling()
    {
        $siswa_bermasalah = Siswa::with(['poinSiswa', 'kelas'])
            ->whereHas('poinSiswa', function($q) {
                $q->where('total_poin', '<', 75);
            })
            ->orderBy('nama_siswa')
            ->get();
            
        return view('bk.konseling.index', compact('siswa_bermasalah'));
    }
    
    public function catatanKonseling()
    {
        // Untuk sementara menggunakan data siswa bermasalah
        $catatan = Siswa::with(['poinSiswa', 'kelas', 'pelanggaran'])
            ->whereHas('poinSiswa', function($q) {
                $q->where('total_poin', '<', 50);
            })
            ->get();
            
        return view('bk.konseling.catatan', compact('catatan'));
    }
    
    public function laporanBk()
    {
        $data = [
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'total_sanksi' => Sanksi::count(),
            'siswa_bermasalah' => Siswa::whereHas('poinSiswa', function($q) {
                $q->where('total_poin', '<', 50);
            })->count(),
            'pelanggaran_bulan_ini' => Pelanggaran::whereMonth('tanggal', now()->month)->count(),
            'sanksi_aktif' => Sanksi::where('status', 'aktif')->count()
        ];
        
        return view('bk.laporan.index', compact('data'));
    }
    
    public function exportLaporanBkPdf()
    {
        $data = [
            'pelanggaran' => Pelanggaran::with(['siswa.kelas', 'jenisPelanggaran'])->get(),
            'sanksi' => Sanksi::with(['siswa.kelas', 'pelanggaran.jenisPelanggaran'])->get(),
            'siswa_bermasalah' => Siswa::with(['poinSiswa', 'kelas'])
                ->whereHas('poinSiswa', function($q) {
                    $q->where('total_poin', '<', 50);
                })->get()
        ];
        
        $pdf = Pdf::loadView('bk.pdf.laporan', compact('data'));
        return $pdf->download('laporan-bk-' . date('Y-m-d') . '.pdf');
    }
}
