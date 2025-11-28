<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('username', $user->username)->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan');
        }

        // Get statistics
        $totalPelanggaran = DB::table('pelanggaran')->where('siswa_id', $siswa->siswa_id)->count();
        $totalPrestasi = DB::table('prestasi')->where('siswa_id', $siswa->siswa_id)->count();
        $totalSanksi = DB::table('sanksi')
            ->join('pelanggaran', 'sanksi.pelanggaran_id', '=', 'pelanggaran.pelanggaran_id')
            ->where('pelanggaran.siswa_id', $siswa->siswa_id)
            ->count();
        
        // Calculate total points
        $totalPoin = DB::table('pelanggaran')
            ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->where('pelanggaran.siswa_id', $siswa->siswa_id)
            ->sum('jenis_pelanggaran.poin');

        return view('siswa.dashboard', compact('siswa', 'totalPelanggaran', 'totalPrestasi', 'totalSanksi', 'totalPoin'));
    }

    public function profil()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')
            ->where('siswa.username', $user->username)
            ->select('siswa.*', 'kelas.nama_kelas')
            ->first();

        return view('siswa.profil', compact('siswa'));
    }

    public function dataSiswa()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')
            ->where('siswa.username', $user->username)
            ->select('siswa.*', 'kelas.nama_kelas')
            ->first();

        return view('siswa.data-siswa', compact('siswa'));
    }

    public function riwayatPelanggaran()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('username', $user->username)->first();
        
        $pelanggaran = DB::table('pelanggaran')
            ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->where('pelanggaran.siswa_id', $siswa->siswa_id)
            ->select('pelanggaran.*', 'jenis_pelanggaran.nama_pelanggaran', 'jenis_pelanggaran.poin')
            ->orderBy('pelanggaran.tanggal', 'desc')
            ->get();

        return view('siswa.riwayat-pelanggaran', compact('pelanggaran'));
    }

    public function riwayatPrestasi()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('username', $user->username)->first();
        
        $prestasi = DB::table('prestasi')
            ->join('jenis_prestasi', 'prestasi.jenis_prestasi_id', '=', 'jenis_prestasi.jenis_prestasi_id')
            ->where('prestasi.siswa_id', $siswa->siswa_id)
            ->select('prestasi.*', 'jenis_prestasi.nama_prestasi', 'jenis_prestasi.poin')
            ->orderBy('prestasi.created_at', 'desc')
            ->get();

        return view('siswa.riwayat-prestasi', compact('prestasi'));
    }

    public function riwayatSanksi()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('username', $user->username)->first();
        
        $sanksi = DB::table('sanksi')
            ->join('pelanggaran', 'sanksi.pelanggaran_id', '=', 'pelanggaran.pelanggaran_id')
            ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->where('pelanggaran.siswa_id', $siswa->siswa_id)
            ->select('sanksi.*', 'jenis_pelanggaran.nama_pelanggaran', 'pelanggaran.tanggal')
            ->orderBy('sanksi.created_at', 'desc')
            ->get();

        return view('siswa.riwayat-sanksi', compact('sanksi'));
    }

    public function totalPoin()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('username', $user->username)->first();
        
        $poinPelanggaran = DB::table('pelanggaran')
            ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->where('pelanggaran.siswa_id', $siswa->siswa_id)
            ->sum('jenis_pelanggaran.poin');

        $poinPrestasi = DB::table('prestasi')
            ->join('jenis_prestasi', 'prestasi.jenis_prestasi_id', '=', 'jenis_prestasi.jenis_prestasi_id')
            ->where('prestasi.siswa_id', $siswa->siswa_id)
            ->sum('jenis_prestasi.poin');

        $totalPoin = $poinPelanggaran - $poinPrestasi;

        return view('siswa.total-poin', compact('poinPelanggaran', 'poinPrestasi', 'totalPoin'));
    }
}