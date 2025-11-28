<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi\Prestasi;
use App\Models\Core\TahunAjaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function prestasi(Request $request)
    {
        $query = Prestasi::with(['siswa', 'jenisPrestasi', 'tahunAjaran']);

        $selectedTahunAjaran = $request->get('tahun_ajaran_id', '');
        $selectedKategori = $request->get('kategori', '');
        $search = $request->get('search', '');

        if ($selectedTahunAjaran) {
            $query->where('tahun_ajaran_id', $selectedTahunAjaran);
        }

        if ($selectedKategori) {
            $query->whereHas('jenisPrestasi', function($q) use ($selectedKategori) {
                $q->where('kategori', $selectedKategori);
            });
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function($sq) use ($search) {
                    $sq->where('nama_siswa', 'like', "%{$search}%");
                })
                ->orWhereHas('jenisPrestasi', function($jq) use ($search) {
                    $jq->where('nama_prestasi', 'like', "%{$search}%");
                });
            });
        }

        $prestasi = $query->orderBy('created_at', 'desc')->paginate(10);

        $stats = [
            'total' => Prestasi::count(),
            'verified' => Prestasi::where('status_verifikasi', 'verified')->count(),
            'pending' => Prestasi::where('status_verifikasi', 'pending')->count(),
        ];

        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();

        return view('admin.laporan.prestasi', compact('prestasi', 'stats', 'tahunAjaranList', 'selectedTahunAjaran', 'selectedKategori', 'search'));
    }
}
