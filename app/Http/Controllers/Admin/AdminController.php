<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Pelanggaran\KategoriPelanggaran;
use App\Models\Sanksi\JenisSanksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ========== USER MANAGEMENT ==========
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function updateLevel(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|in:admin,kesiswaan,guru,kepsek,bk,wali_kelas,siswa,ortu',
        ]);

        $user = User::findOrFail($id);
        $user->level = $request->level;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Level user berhasil diubah!');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Status user berhasil diubah!');
    }

    // ========== PELANGGARAN MANAGEMENT ==========
    
    public function pelanggaran()
    {
        $pelanggaran = JenisPelanggaran::orderBy('created_at', 'desc')->get();
        return view('admin.pelanggaran', compact('pelanggaran'));
    }

    public function createPelanggaran()
    {
        return view('admin.pelanggaran-create');
    }

    public function storePelanggaran(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        JenisPelanggaran::create($request->all());
        return redirect()->route('admin.pelanggaran')->with('success', 'Jenis pelanggaran berhasil ditambahkan!');
    }

    public function editPelanggaran($id)
    {
        $pelanggaran = JenisPelanggaran::findOrFail($id);
        return view('admin.pelanggaran-edit', compact('pelanggaran'));
    }

    public function updatePelanggaran(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggaran' => 'required',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        $pelanggaran = JenisPelanggaran::findOrFail($id);
        $pelanggaran->update($request->all());

        return redirect()->route('admin.pelanggaran')->with('success', 'Jenis pelanggaran berhasil diupdate!');
    }

    public function deletePelanggaran($id)
    {
        $pelanggaran = JenisPelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->route('admin.pelanggaran')->with('success', 'Jenis pelanggaran berhasil dihapus!');
    }

    // ========== JENIS PELANGGARAN MANAGEMENT ==========

    public function jenisPelanggaran()
    {
        $jenisPelanggaran = JenisPelanggaran::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jenis-pelanggaran.index', compact('jenisPelanggaran'));
    }

    public function createJenisPelanggaran()
    {
        return view('admin.jenis-pelanggaran.create');
    }

    public function storeJenisPelanggaran(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string',
            'deskripsi' => 'nullable|string',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        // Auto-generate kode pelanggaran
        $kategoriPrefix = [
            'ringan' => 'R',
            'sedang' => 'S', 
            'berat' => 'B'
        ];
        
        $lastKode = JenisPelanggaran::where('kategori', $request->kategori)
            ->orderBy('jenis_pelanggaran_id', 'desc')
            ->first();
            
        $nextNumber = $lastKode ? (int)substr($lastKode->kode_pelanggaran, 1) + 1 : 1;
        $data['kode_pelanggaran'] = $kategoriPrefix[$request->kategori] . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        
        JenisPelanggaran::create($data);
        return redirect()->route('admin.jenis-pelanggaran')->with('success', 'Jenis pelanggaran berhasil ditambahkan!');
    }

    public function editJenisPelanggaran($id)
    {
        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        return view('admin.jenis-pelanggaran.edit', compact('jenisPelanggaran'));
    }

    public function updateJenisPelanggaran(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string',
            'deskripsi' => 'nullable|string',
            'poin' => 'required|integer|min:1',
            'kategori' => 'required|in:ringan,sedang,berat',
        ]);

        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        // Update kode jika kategori berubah
        if ($jenisPelanggaran->kategori !== $request->kategori) {
            $kategoriPrefix = [
                'ringan' => 'R',
                'sedang' => 'S', 
                'berat' => 'B'
            ];
            
            $lastKode = JenisPelanggaran::where('kategori', $request->kategori)
                ->where('jenis_pelanggaran_id', '!=', $id)
                ->orderBy('jenis_pelanggaran_id', 'desc')
                ->first();
                
            $nextNumber = $lastKode ? (int)substr($lastKode->kode_pelanggaran, 1) + 1 : 1;
            $data['kode_pelanggaran'] = $kategoriPrefix[$request->kategori] . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        }
        
        $jenisPelanggaran->update($data);
        return redirect()->route('admin.jenis-pelanggaran')->with('success', 'Jenis pelanggaran berhasil diupdate!');
    }

    public function deleteJenisPelanggaran($id)
    {
        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        $jenisPelanggaran->delete();
        return redirect()->route('admin.jenis-pelanggaran')->with('success', 'Jenis pelanggaran berhasil dihapus!');
    }

    // ========== KATEGORI PELANGGARAN MANAGEMENT ==========

    public function kategoriPelanggaran()
    {
        $kategori = KategoriPelanggaran::orderBy('created_at', 'desc')->get();
        return view('admin.kategori-pelanggaran.index', compact('kategori'));
    }

    public function createKategoriPelanggaran()
    {
        return view('admin.kategori-pelanggaran.create');
    }

    public function storeKategoriPelanggaran(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_pelanggaran,nama_kategori',
            'deskripsi' => 'nullable|string',
            'warna' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        KategoriPelanggaran::create($data);
        return redirect()->route('admin.kategori-pelanggaran')->with('success', 'Kategori pelanggaran berhasil ditambahkan!');
    }

    public function editKategoriPelanggaran($id)
    {
        $kategori = KategoriPelanggaran::findOrFail($id);
        return view('admin.kategori-pelanggaran.edit', compact('kategori'));
    }

    public function updateKategoriPelanggaran(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_pelanggaran,nama_kategori,' . $id . ',kategori_id',
            'deskripsi' => 'nullable|string',
            'warna' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
        ]);

        $kategori = KategoriPelanggaran::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $kategori->update($data);

        return redirect()->route('admin.kategori-pelanggaran')->with('success', 'Kategori pelanggaran berhasil diupdate!');
    }

    public function deleteKategoriPelanggaran($id)
    {
        $kategori = KategoriPelanggaran::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori-pelanggaran')->with('success', 'Kategori pelanggaran berhasil dihapus!');
    }

    // ========== JENIS SANKSI MANAGEMENT ==========

    public function jenisSanksi()
    {
        $jenisSanksi = JenisSanksi::orderBy('created_at', 'desc')->get();
        return view('admin.jenis-sanksi.index', compact('jenisSanksi'));
    }

    public function createJenisSanksi()
    {
        return view('admin.jenis-sanksi.create');
    }

    public function storeJenisSanksi(Request $request)
    {
        $request->validate([
            'nama_sanksi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        JenisSanksi::create($request->all());
        return redirect()->route('admin.jenis-sanksi')->with('success', 'Jenis sanksi berhasil ditambahkan!');
    }

    public function editJenisSanksi($id)
    {
        $jenisSanksi = JenisSanksi::findOrFail($id);
        return view('admin.jenis-sanksi.edit', compact('jenisSanksi'));
    }

    public function updateJenisSanksi(Request $request, $id)
    {
        $request->validate([
            'nama_sanksi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        $jenisSanksi = JenisSanksi::findOrFail($id);
        $jenisSanksi->update($request->all());
        return redirect()->route('admin.jenis-sanksi')->with('success', 'Jenis sanksi berhasil diupdate!');
    }

    public function deleteJenisSanksi($id)
    {
        $jenisSanksi = JenisSanksi::findOrFail($id);
        $jenisSanksi->delete();
        return redirect()->route('admin.jenis-sanksi')->with('success', 'Jenis sanksi berhasil dihapus!');
    }
}