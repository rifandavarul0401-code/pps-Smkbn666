<?php

namespace App\Http\Controllers\kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Siswa\Siswa;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'pending_verifikasi' => Pelanggaran::where('status_verifikasi', 'pending')->count() + 
                                    Prestasi::where('status_verifikasi', 'pending')->count()
        ];
        
        $recentPelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();
            
        $recentPrestasi = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('kesiswaan.monitoring.index', compact('stats', 'recentPelanggaran', 'recentPrestasi'));
    }
}
