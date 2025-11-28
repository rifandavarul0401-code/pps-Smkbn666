<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Pelanggaran\JenisPelanggaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelanggaranSiswaController extends Controller
{
    public function index()
    {
        $pelanggaran = Pelanggaran::with('jenisPelanggaran')
            ->join('siswa', 'pelanggaran.siswa_id', '=', 'siswa.siswa_id')
            ->select('pelanggaran.*', 'siswa.nis', 'siswa.nama_siswa')
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.pelanggaran-siswa.index', compact('pelanggaran'));
    }

    public function create()
    {
        $jenisPelanggaran = JenisPelanggaran::where('is_active', true)->get();
        $siswa = DB::table('siswa')->where('status', 'aktif')->get();
        return view('admin.pelanggaran-siswa.create', compact('jenisPelanggaran', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|integer',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,jenis_pelanggaran_id',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $jenisPelanggaran = JenisPelanggaran::findOrFail($request->jenis_pelanggaran_id);
        
        Pelanggaran::create([
            'siswa_id' => $request->siswa_id,
            'guru_pencatat' => auth()->user()->user_id ?? 1,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'tahun_ajaran_id' => 1,
            'poin' => $jenisPelanggaran->poin,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'status_verifikasi' => 'pending'
        ]);

        return redirect()->route('admin.pelanggaran-siswa.index')->with('success', 'Catatan pelanggaran berhasil ditambahkan!');
    }
}