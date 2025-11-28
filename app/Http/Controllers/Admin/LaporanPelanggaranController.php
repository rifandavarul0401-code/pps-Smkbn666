<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();
        $selectedTahunAjaran = $request->tahun_ajaran_id;
        $search = $request->search;
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'tahunAjaran'])
            ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })
            ->when($search, function($q) use ($search) {
                return $q->whereHas('siswa', function($query) use ($search) {
                    $query->where('nama_lengkap', 'like', '%' . $search . '%');
                })->orWhereHas('jenisPelanggaran', function($query) use ($search) {
                    $query->where('nama_pelanggaran', 'like', '%' . $search . '%');
                });
            })
            ->when($tanggalMulai, function($q) use ($tanggalMulai) {
                return $q->where('tanggal', '>=', $tanggalMulai);
            })
            ->when($tanggalSelesai, function($q) use ($tanggalSelesai) {
                return $q->where('tanggal', '<=', $tanggalSelesai);
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Pelanggaran::when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
            })->count(),
            'verified' => Pelanggaran::where('status_verifikasi', 'verified')
                ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                    return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
                })->count(),
            'pending' => Pelanggaran::where('status_verifikasi', 'pending')
                ->when($selectedTahunAjaran, function($q) use ($selectedTahunAjaran) {
                    return $q->where('tahun_ajaran_id', $selectedTahunAjaran);
                })->count()
        ];

        return view('admin.laporan.pelanggaran', compact('pelanggaran', 'tahunAjaranList', 'selectedTahunAjaran', 'stats', 'search', 'tanggalMulai', 'tanggalSelesai'));
    }
}