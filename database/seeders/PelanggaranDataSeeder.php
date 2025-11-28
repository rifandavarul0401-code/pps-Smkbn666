<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\JenisPelanggaran;

class PelanggaranDataSeeder extends Seeder
{
    public function run()
    {
        $siswaIds = Siswa::pluck('siswa_id')->toArray();
        $jenisIds = JenisPelanggaran::pluck('jenis_pelanggaran_id')->toArray();
        
        for ($i = 1; $i <= 34; $i++) {
            Pelanggaran::create([
                'siswa_id' => $siswaIds[array_rand($siswaIds)],
                'jenis_pelanggaran_id' => $jenisIds[array_rand($jenisIds)],
                'tanggal' => now()->subDays(rand(1, 30)),
                'poin' => rand(5, 25),
                'keterangan' => 'Pelanggaran ke-' . $i,
                'status_verifikasi' => ['pending', 'verified'][array_rand(['pending', 'verified'])],
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now()->subDays(rand(1, 30))
            ]);
        }
    }
}