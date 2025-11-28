<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa\Siswa;
use App\Models\Siswa\PoinSiswa;

class PoinSiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        
        foreach ($siswa as $s) {
            PoinSiswa::firstOrCreate([
                'siswa_id' => $s->siswa_id
            ], [
                'total_poin' => 100,
                'poin_pelanggaran' => 0,
                'poin_prestasi' => 0
            ]);
        }
    }
}