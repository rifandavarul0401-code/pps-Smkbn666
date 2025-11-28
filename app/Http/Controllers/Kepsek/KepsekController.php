<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Sanksi\Sanksi;
use Carbon\Carbon;

class KepsekController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'pending_verifikasi' => Pelanggaran::where('status_verifikasi', 'pending')->count() + 
                Prestasi::where('status_verifikasi', 'pending')->count(),
            'sanksi_aktif' => Sanksi::where('status', 'aktif')->count()
        ];

        $recentPelanggaran = Pelanggaran::with(['jenisPelanggaran', 'siswa', 'tahunAjaran'])
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $recentPrestasi = Prestasi::with(['jenisPrestasi', 'siswa', 'tahunAjaran'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('kepsek.dashboard', compact('stats', 'recentPelanggaran', 'recentPrestasi'));
    }

    public function statistik()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_guru' => \App\Models\Guru\Guru::count(),
            'total_pelanggaran' => Pelanggaran::count(),
            'total_prestasi' => Prestasi::count(),
            'pelanggaran_verified' => Pelanggaran::where('status_verifikasi', 'verified')->count(),
            'prestasi_verified' => Prestasi::where('status_verifikasi', 'verified')->count(),
        ];

        return view('kepsek.statistik', compact('stats'));
    }

    public function siswa()
    {
        $siswa = Siswa::with('kelas')->paginate(15);
        return view('kepsek.siswa', compact('siswa'));
    }

    public function guru()
    {
        $guru = \App\Models\Guru\Guru::paginate(15);
        return view('kepsek.guru', compact('guru'));
    }

    public function laporanPelanggaran()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'tahunAjaran'])
            ->orderBy('tanggal', 'desc')
            ->paginate(15);
        return view('kepsek.laporan.pelanggaran', compact('pelanggaran'));
    }

    public function laporanPrestasi()
    {
        $prestasi = Prestasi::with(['siswa', 'jenisPrestasi', 'tahunAjaran'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('kepsek.laporan.prestasi', compact('prestasi'));
    }

    public function laporanSanksi()
    {
        $sanksi = Sanksi::with(['pelanggaran.siswa', 'pelanggaran.jenisPelanggaran'])
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(15);
        return view('kepsek.laporan.sanksi', compact('sanksi'));
    }

    public function laporanBulanan()
    {
        $bulan = request('bulan', date('Y-m'));
        
        $stats = [
            'pelanggaran' => Pelanggaran::whereYear('tanggal', substr($bulan, 0, 4))
                ->whereMonth('tanggal', substr($bulan, 5, 2))
                ->count(),
            'prestasi' => Prestasi::whereYear('created_at', substr($bulan, 0, 4))
                ->whereMonth('created_at', substr($bulan, 5, 2))
                ->count(),
            'sanksi' => Sanksi::whereYear('tanggal_mulai', substr($bulan, 0, 4))
                ->whereMonth('tanggal_mulai', substr($bulan, 5, 2))
                ->count(),
        ];

        return view('kepsek.laporan.bulanan', compact('stats', 'bulan'));
    }
}