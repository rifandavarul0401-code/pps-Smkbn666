<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi\Prestasi;
use App\Models\Siswa\Siswa;
use App\Models\Prestasi\JenisPrestasi;
use App\Models\Core\TahunAjaran;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        $jenisPrestasi = JenisPrestasi::all();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();

        if ($siswa->count() > 0 && $jenisPrestasi->count() > 0 && $tahunAjaran) {
            for ($i = 1; $i <= 120; $i++) {
                $randomSiswa = $siswa->random();
                $randomJenis = $jenisPrestasi->random();
                
                Prestasi::create([
                    'siswa_id' => $randomSiswa->siswa_id,
                    'jenis_prestasi_id' => $randomJenis->jenis_prestasi_id,
                    'poin' => $randomJenis->poin,
                    'keterangan' => 'Prestasi ' . $randomJenis->nama_prestasi . ' oleh ' . $randomSiswa->nama_siswa,
                    'status_verifikasi' => rand(0, 1) ? 'pending' : 'verified',
                    'guru_pencatat' => 1,
                    'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id
                ]);
            }
        }
    }
}