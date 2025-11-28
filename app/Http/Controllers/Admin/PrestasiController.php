<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi\Prestasi;
use App\Models\Prestasi\JenisPrestasi;
use App\Models\Siswa\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::with(['siswa', 'jenisPrestasi'])->latest()->paginate(20);
        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $jenisPrestasi = JenisPrestasi::all();
        return view('admin.prestasi.create', compact('siswa', 'jenisPrestasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_prestasi_id' => 'required|exists:jenis_prestasi,jenis_prestasi_id',
            'tanggal_prestasi' => 'required|date',
            'keterangan' => 'required|string'
        ]);

        $jenisPrestasi = JenisPrestasi::find($request->jenis_prestasi_id);
        $tahunAjaran = \App\Models\Core\TahunAjaran::where('status_aktif', true)->first();
        
        Prestasi::create([
            'siswa_id' => $request->siswa_id,
            'jenis_prestasi_id' => $request->jenis_prestasi_id,
            'tanggal_prestasi' => $request->tanggal_prestasi,
            'poin' => $jenisPrestasi->poin,
            'keterangan' => $request->keterangan,
            'status_verifikasi' => 'pending',
            'guru_pencatat' => auth()->user()->user_id,
            'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id ?? 1
        ]);

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function show(Prestasi $prestasi)
    {
        $prestasi->load(['siswa', 'jenisPrestasi', 'createdBy']);
        return view('admin.prestasi.show', compact('prestasi'));
    }

    public function edit(Prestasi $prestasi)
    {
        $siswa = Siswa::all();
        $jenisPrestasi = JenisPrestasi::all();
        return view('admin.prestasi.edit', compact('prestasi', 'siswa', 'jenisPrestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'jenis_prestasi_id' => 'required|exists:jenis_prestasi,jenis_prestasi_id',
            'tanggal_prestasi' => 'required|date',
            'keterangan' => 'required|string'
        ]);

        $jenisPrestasi = JenisPrestasi::find($request->jenis_prestasi_id);
        
        $prestasi->update([
            'siswa_id' => $request->siswa_id,
            'jenis_prestasi_id' => $request->jenis_prestasi_id,
            'tanggal_prestasi' => $request->tanggal_prestasi,
            'poin' => $jenisPrestasi->poin,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diupdate');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus');
    }

    public function verify(Prestasi $prestasi)
    {
        $prestasi->update(['status' => 'verified', 'verified_by' => auth()->id()]);
        return redirect()->back()->with('success', 'Prestasi berhasil diverifikasi');
    }

    public function jenisPrestasi()
    {
        $jenisPrestasi = JenisPrestasi::latest()->paginate(10);
        return view('admin.prestasi.jenis-prestasi.index', compact('jenisPrestasi'));
    }

    public function createJenisPrestasi()
    {
        return view('admin.prestasi.jenis-prestasi.create');
    }

    public function storeJenisPrestasi(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:akademik,non_akademik,olahraga,seni,lainnya',
            'sanksi_rekomendasi' => 'nullable|string'
        ]);

        JenisPrestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'poin' => $request->poin,
            'kategori' => $request->kategori,
            'sanksi_rekomendasi' => $request->sanksi_rekomendasi
        ]);
        return redirect()->route('admin.prestasi.jenis-prestasi.index')->with('success', 'Jenis prestasi berhasil ditambahkan');
    }

    public function editJenisPrestasi($id)
    {
        $jenisPrestasi = JenisPrestasi::findOrFail($id);
        return view('admin.prestasi.jenis-prestasi.edit', compact('jenisPrestasi'));
    }

    public function updateJenisPrestasi(Request $request, $id)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:akademik,non_akademik,olahraga,seni,lainnya',
            'sanksi_rekomendasi' => 'nullable|string'
        ]);

        $jenisPrestasi = JenisPrestasi::findOrFail($id);
        $jenisPrestasi->update([
            'nama_prestasi' => $request->nama_prestasi,
            'poin' => $request->poin,
            'kategori' => $request->kategori,
            'sanksi_rekomendasi' => $request->sanksi_rekomendasi
        ]);
        
        return redirect()->route('admin.prestasi.jenis-prestasi.index')->with('success', 'Jenis prestasi berhasil diupdate');
    }

    public function destroyJenisPrestasi($id)
    {
        $jenisPrestasi = JenisPrestasi::findOrFail($id);
        $jenisPrestasi->delete();
        return redirect()->route('admin.prestasi.jenis-prestasi.index')->with('success', 'Jenis prestasi berhasil dihapus');
    }
}