<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi\Prestasi;
use App\Models\Siswa\Siswa;
use App\Models\Prestasi\JenisPrestasi;

class PrestasiDataSeeder extends Seeder
{
    public function run()
    {
        $siswaIds = Siswa::pluck('siswa_id')->toArray();
        $jenisPrestasiIds = JenisPrestasi::pluck('jenis_prestasi_id')->toArray();
        
        for ($i = 1; $i <= 58; $i++) {
            Prestasi::create([
                'siswa_id' => $siswaIds[array_rand($siswaIds)],
                'jenis_prestasi_id' => $jenisPrestasiIds[array_rand($jenisPrestasiIds)],
                'poin' => rand(5, 20),
                'keterangan' => 'Prestasi ke-' . $i,
                'status_verifikasi' => ['pending', 'verified'][array_rand(['pending', 'verified'])],
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now()->subDays(rand(1, 30))
            ]);
        }
    }
}