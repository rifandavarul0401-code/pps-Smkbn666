<?php

namespace App\Http\Controllers\kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $pelanggaranPending = Pelanggaran::with(['siswa', 'jenisPelanggaran'])
            ->where('status_verifikasi', 'pending')
            ->orderBy('tanggal', 'desc')
            ->get();
            
        $prestasiPending = Prestasi::with(['siswa', 'jenisPrestasi'])
            ->where('status_verifikasi', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        
        
        return view('kesiswaan.verifikasi.index', compact('pelanggaranPending', 'prestasiPending'));
    }

    public function verifyPelanggaran($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->status_verifikasi = 'verified';
        $pelanggaran->save();
        
        return redirect()->back()->with('success', 'Pelanggaran berhasil diverifikasi');
    }

    public function rejectPelanggaran($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->status_verifikasi = 'rejected';
        $pelanggaran->save();
        
        return redirect()->back()->with('success', 'Pelanggaran ditolak');
    }

    public function verifyPrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_verifikasi = 'verified';
        $prestasi->save();
        
        return redirect()->back()->with('success', 'Prestasi berhasil diverifikasi');
    }

    public function rejectPrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_verifikasi = 'rejected';
        $prestasi->save();
        
        return redirect()->back()->with('success', 'Prestasi ditolak');
    }
}
