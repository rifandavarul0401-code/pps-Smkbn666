<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Sanksi\Sanksi;
use App\Models\User;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('status_aktif', true)->first();
        $selectedTahunAjaran = $request->tahun_ajaran_id ?? ($tahunAjaranAktif->tahun_ajaran_id ?? null);

        $stats = [
            'total_siswa' => Siswa::count(),
            'total_pelanggaran' => Pelanggaran::when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })->count(),
            'total_prestasi' => Prestasi::when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })->count(),
            'pending_verifikasi' => Pelanggaran::where('status_verifikasi', 'pending')
                ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                    return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
                })->count() + 
                Prestasi::where('status_verifikasi', 'pending')
                ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                    return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
                })->count()
        ];

        // Data untuk grafik pelanggaran per bulan (SQLite compatible)
        $pelanggaranPerBulan = Pelanggaran::select(
                DB::raw('CAST(strftime(\'%m\', tanggal) AS INTEGER) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->where(DB::raw('strftime(\'%Y\', tanggal)'), '=', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data untuk grafik prestasi per bulan (real data)
        $prestasiPerBulan = Prestasi::select(
                DB::raw('CAST(strftime(\'%m\', created_at) AS INTEGER) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->where(DB::raw('strftime(\'%Y\', created_at)'), '=', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data untuk grafik kategori pelanggaran
        $pelanggaranKategori = Pelanggaran::join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->select('jenis_pelanggaran.kategori', DB::raw('COUNT(*) as total'))
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('pelanggaran.tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->groupBy('jenis_pelanggaran.kategori')
            ->get();

        $recentPelanggaran = Pelanggaran::with(['jenisPelanggaran', 'siswa', 'tahunAjaran'])
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();

        $recentPrestasi = Prestasi::with(['jenisPrestasi', 'siswa', 'tahunAjaran'])
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $activeSanksi = Sanksi::with(['pelanggaran.siswa'])
            ->where('status', 'aktif')
            ->orderBy('tanggal_mulai', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 
            'recentPelanggaran', 
            'recentPrestasi', 
            'activeSanksi',
            'tahunAjaranList',
            'selectedTahunAjaran',
            'pelanggaranPerBulan',
            'prestasiPerBulan',
            'pelanggaranKategori'
        ));
    }
}