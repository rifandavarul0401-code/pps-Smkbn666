<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Sanksi\Sanksi;
use App\Models\Prestasi\Prestasi;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function sanksiBerat()
    {
        $sanksiPending = Sanksi::with(['pelanggaran.siswa', 'pelanggaran.jenisPelanggaran'])
            ->whereHas('pelanggaran.jenisPelanggaran', function($query) {
                $query->where('kategori', 'berat');
            })
            ->where('status', 'aktif')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
            
        return view('kepsek.persetujuan.sanksi-berat', compact('sanksiPending'));
    }

    public function penghargaan()
    {
        $prestasiPending = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->whereHas('jenisPrestasi', function($query) {
                $query->where('tingkat', 'nasional')
                      ->orWhere('tingkat', 'internasional');
            })
            ->where('status_verifikasi', 'verified')
            ->orderBy('tanggal_prestasi', 'desc')
            ->get();
            
        return view('kepsek.persetujuan.penghargaan', compact('prestasiPending'));
    }

    public function approveSanksi($id)
    {
        $sanksi = Sanksi::findOrFail($id);
        $sanksi->status = 'selesai';
        $sanksi->save();
        
        return redirect()->back()->with('success', 'Sanksi berhasil disetujui');
    }

    public function approvePrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_verifikasi = 'approved';
        $prestasi->save();
        
        return redirect()->back()->with('success', 'Penghargaan berhasil disetujui');
    }
}