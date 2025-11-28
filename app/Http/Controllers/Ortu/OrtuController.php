<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;

class OrtuController extends Controller
{
    public function dashboard()
    {
        $siswaUser = \App\Models\User::where('username', 'siswa1')->first();
        
        if ($siswaUser) {
            $siswa = Siswa::where('nama_lengkap', $siswaUser->nama_lengkap)->first();
            
            if ($siswa) {
                $pelanggaran = Pelanggaran::with(['jenisPelanggaran'])
                    ->where('siswa_id', $siswa->id)
                    ->latest()
                    ->take(5)
                    ->get();
                
                $prestasi = Prestasi::with(['jenisPrestasi'])
                    ->where('siswa_id', $siswa->id)
                    ->latest()
                    ->take(5)
                    ->get();
                
                $stats = [
                    'nama_anak' => $siswaUser->nama_lengkap,
                    'total_poin' => 100 - $pelanggaran->sum('poin') + $prestasi->sum('poin'),
                    'total_pelanggaran' => Pelanggaran::where('siswa_id', $siswa->id)->count(),
                    'total_prestasi' => Prestasi::where('siswa_id', $siswa->id)->count(),
                ];
            } else {
                $pelanggaran = collect();
                $prestasi = collect();
                $stats = ['nama_anak' => $siswaUser->nama_lengkap, 'total_poin' => 100, 'total_pelanggaran' => 0, 'total_prestasi' => 0];
            }
        } else {
            $pelanggaran = collect();
            $prestasi = collect();
            $stats = ['nama_anak' => 'Data tidak ditemukan', 'total_poin' => 100, 'total_pelanggaran' => 0, 'total_prestasi' => 0];
        }
        
        return view('ortu.dashboard', compact('stats', 'pelanggaran', 'prestasi'));
    }

    public function dataSendiri()
    {
        $user = auth()->user();
        $orangtua = \App\Models\Ortu\Orangtua::where('user_id', $user->user_id)->first();
        return view('ortu.data-sendiri', compact('user', 'orangtua'));
    }

    public function dataAnak()
    {
        $siswaUser = \App\Models\User::where('username', 'siswa1')->first();
        
        if ($siswaUser) {
            $siswa = Siswa::where('nama_lengkap', $siswaUser->nama_lengkap)->first();
            
            if ($siswa) {
                $pelanggaran = Pelanggaran::with(['jenisPelanggaran'])
                    ->where('siswa_id', $siswa->id)
                    ->latest()
                    ->get();
                
                $prestasi = Prestasi::with(['jenisPrestasi'])
                    ->where('siswa_id', $siswa->id)
                    ->latest()
                    ->get();
                
                $totalPoin = 100 - $pelanggaran->sum('poin') + $prestasi->sum('poin');
            } else {
                $pelanggaran = collect();
                $prestasi = collect();
                $totalPoin = 100;
            }
        } else {
            $siswaUser = null;
            $siswa = null;
            $pelanggaran = collect();
            $prestasi = collect();
            $totalPoin = 100;
        }
        
        return view('ortu.data-anak', compact('siswaUser', 'siswa', 'pelanggaran', 'prestasi', 'totalPoin'));
    }
}