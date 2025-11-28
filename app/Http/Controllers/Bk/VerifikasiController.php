<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function pelanggaran()
    {
        $pelanggaran = Pelanggaran::with(['siswa.kelas', 'jenisPelanggaran', 'guruPencatat'])
            ->where('status_verifikasi', 'pending')
            ->latest()
            ->get();
        return view('bk.verifikasi.pelanggaran', compact('pelanggaran'));
    }

    public function verifyPelanggaran(Pelanggaran $pelanggaran)
    {
        $pelanggaran->update([
            'status_verifikasi' => 'verified',
            'guru_verifikator' => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }

    public function rejectPelanggaran(Pelanggaran $pelanggaran, Request $request)
    {
        $pelanggaran->update([
            'status_verifikasi' => 'rejected',
            'guru_verifikator' => auth()->id(),
            'catatan_verifikasi' => $request->catatan_verifikasi
        ]);

        return redirect()->back()->with('success', 'Pelanggaran ditolak');
    }
}