<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sanksi\Sanksi;
use App\Models\Sanksi\PelaksanaanSanksi;
use App\Models\Pelanggaran\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanksiController extends Controller
{
    public function index()
    {
        $sanksi = Sanksi::join('pelanggaran', 'sanksi.pelanggaran_id', '=', 'pelanggaran.pelanggaran_id')
            ->join('siswa', 'pelanggaran.siswa_id', '=', 'siswa.siswa_id')
            ->select('sanksi.*', 'siswa.nis', 'siswa.nama_siswa')
            ->orderBy('sanksi.created_at', 'desc')
            ->paginate(20);
        
        return view('admin.sanksi.index', compact('sanksi'));
    }

    public function create()
    {
        $pelanggaran = Pelanggaran::join('siswa', 'pelanggaran.siswa_id', '=', 'siswa.siswa_id')
            ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.jenis_pelanggaran_id')
            ->select('pelanggaran.*', 'siswa.nis', 'siswa.nama_siswa', 'jenis_pelanggaran.nama_pelanggaran')
            ->where('pelanggaran.status_verifikasi', 'verified')
            ->get();
        
        return view('admin.sanksi.create', compact('pelanggaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggaran_id' => 'required|exists:pelanggaran,pelanggaran_id',
            'jenis_sanksi' => 'required|string',
            'deskripsi_sanksi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Sanksi::create([
            'pelanggaran_id' => $request->pelanggaran_id,
            'jenis_sanksi' => $request->jenis_sanksi,
            'deskripsi_sanksi' => $request->deskripsi_sanksi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status ?? 'aktif'
        ]);
        
        return redirect()->route('admin.sanksi.index')->with('success', 'Sanksi berhasil ditambahkan!');
    }

    public function pelaksanaan($sanksi_id)
    {
        $sanksi = Sanksi::join('pelanggaran', 'sanksi.pelanggaran_id', '=', 'pelanggaran.pelanggaran_id')
            ->join('siswa', 'pelanggaran.siswa_id', '=', 'siswa.siswa_id')
            ->select('sanksi.*', 'siswa.nis', 'siswa.nama_siswa')
            ->where('sanksi.sanksi_id', $sanksi_id)
            ->first();
        
        $pelaksanaan = PelaksanaanSanksi::where('sanksi_id', $sanksi_id)->get();
        
        return view('admin.sanksi.pelaksanaan', compact('sanksi', 'pelaksanaan'));
    }

    public function storePelaksanaan(Request $request, $sanksi_id)
    {
        $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'catatan' => 'nullable|string',
            'status' => 'required|in:terlaksana,tidak_terlaksana,pending',
        ]);

        PelaksanaanSanksi::create([
            'sanksi_id' => $sanksi_id,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'bukti_pelaksanaan' => null,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sanksi.pelaksanaan', $sanksi_id)->with('success', 'Pelaksanaan sanksi berhasil dicatat!');
    }
}