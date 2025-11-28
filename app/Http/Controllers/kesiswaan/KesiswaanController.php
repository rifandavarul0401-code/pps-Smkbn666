<?php

namespace App\Http\Controllers\kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Core\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class KesiswaanController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'siswa_aktif' => Siswa::count(),
            'perlu_verifikasi' => Pelanggaran::where('status_verifikasi', 'pending')->count() + 
                                  Prestasi::where('status_verifikasi', 'pending')->count(),
            'pelanggaran_bulan_ini' => Pelanggaran::whereMonth('tanggal', Carbon::now()->month)
                                                   ->whereYear('tanggal', Carbon::now()->year)
                                                   ->count(),
            'prestasi_bulan_ini' => Prestasi::whereMonth('created_at', Carbon::now()->month)
                                            ->whereYear('created_at', Carbon::now()->year)
                                            ->count()
        ];
        
        return view('kesiswaan.dashboard', compact('stats'));
    }

    public function dataKesiswaan()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_kelas' => Kelas::count(),
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'pelanggaran_pending' => Pelanggaran::where('status_verifikasi', 'pending')->count(),
            'prestasi_pending' => Prestasi::where('status_verifikasi', 'pending')->count()
        ];
        
        return view('kesiswaan.data-kesiswaan', compact('stats'));
    }

    public function dataSiswa(Request $request)
    {
        $query = Siswa::with(['kelas', 'poinSiswa'])->orderBy('nama_siswa', 'asc');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->has('kelas') && $request->kelas) {
            $query->where('kelas_id', $request->kelas);
        }
        
        $siswa = $query->paginate(10);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        
        return view('kesiswaan.data-siswa', compact('siswa', 'kelas'));
    }

    public function exportLaporan(Request $request)
    {
        $type = $request->get('type', 'pelanggaran');
        $format = $request->get('format', 'preview');
        
        if ($type === 'pelanggaran') {
            $data = Pelanggaran::with(['siswa.kelas', 'jenisPelanggaran'])
                ->when($request->start_date, function($q) use ($request) {
                    return $q->whereDate('tanggal', '>=', $request->start_date);
                })
                ->when($request->end_date, function($q) use ($request) {
                    return $q->whereDate('tanggal', '<=', $request->end_date);
                })
                ->orderBy('tanggal', 'desc')
                ->get();
        } else {
            $data = Prestasi::with(['siswa.kelas', 'jenisPrestasi'])
                ->when($request->start_date, function($q) use ($request) {
                    return $q->whereDate('created_at', '>=', $request->start_date);
                })
                ->when($request->end_date, function($q) use ($request) {
                    return $q->whereDate('created_at', '<=', $request->end_date);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        if ($format === 'pdf') {
            return $this->exportPDF($data, $type, $request);
        }
        
        return view('kesiswaan.export-laporan', compact('data', 'type'));
    }
    
    public function exportPDF($data, $type, $request)
    {
        $periode = '';
        if ($request->start_date && $request->end_date) {
            $periode = date('d/m/Y', strtotime($request->start_date)) . ' - ' . date('d/m/Y', strtotime($request->end_date));
        } elseif ($request->start_date) {
            $periode = 'Sejak ' . date('d/m/Y', strtotime($request->start_date));
        } elseif ($request->end_date) {
            $periode = 'Sampai ' . date('d/m/Y', strtotime($request->end_date));
        } else {
            $periode = 'Semua Data';
        }
        
        $pdf = Pdf::loadView('kesiswaan.pdf.' . $type, compact('data', 'type', 'periode'));
        return $pdf->download('laporan-' . $type . '-kesiswaan-' . date('Y-m-d') . '.pdf');
    }
    
    public function exportPelanggaranPdf(Request $request)
    {
        $data = Pelanggaran::with(['siswa.kelas', 'jenisPelanggaran'])
            ->when($request->start_date, function($q) use ($request) {
                return $q->whereDate('tanggal', '>=', $request->start_date);
            })
            ->when($request->end_date, function($q) use ($request) {
                return $q->whereDate('tanggal', '<=', $request->end_date);
            })
            ->orderBy('tanggal', 'desc')
            ->get();
            
        $periode = 'Semua Data';
        if ($request->start_date && $request->end_date) {
            $periode = date('d/m/Y', strtotime($request->start_date)) . ' - ' . date('d/m/Y', strtotime($request->end_date));
        }
        
        $pdf = Pdf::loadView('kesiswaan.pdf.pelanggaran', compact('data', 'periode'));
        return $pdf->download('laporan-pelanggaran-kesiswaan-' . date('Y-m-d') . '.pdf');
    }
    
    public function exportPrestasiPdf(Request $request)
    {
        $data = Prestasi::with(['siswa.kelas', 'jenisPrestasi'])
            ->when($request->start_date, function($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->end_date);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        $periode = 'Semua Data';
        if ($request->start_date && $request->end_date) {
            $periode = date('d/m/Y', strtotime($request->start_date)) . ' - ' . date('d/m/Y', strtotime($request->end_date));
        }
        
        $pdf = Pdf::loadView('kesiswaan.pdf.prestasi', compact('data', 'periode'));
        return $pdf->download('laporan-prestasi-kesiswaan-' . date('Y-m-d') . '.pdf');
    }


}
