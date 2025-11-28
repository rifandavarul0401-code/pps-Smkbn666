<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Core\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $tingkat = ['X', 'XI', 'XII'];
        $jurusan = [
            'PPLG' => 'Pengembangan Perangkat Lunak dan Gim',
            'DKV' => 'Desain Komunikasi Visual',
            'ANM' => 'Animasi',
            'AKT' => 'Akuntansi',
            'PMS' => 'Pemasaran'
        ];
        
        $kelas = [];
        foreach ($tingkat as $t) {
            foreach ($jurusan as $kode => $nama) {
                for ($i = 1; $i <= 2; $i++) {
                    $kelas[] = [
                        'nama_kelas' => "{$t} {$kode} {$i}",
                        'jurusan' => $nama,
                        'kapasitas' => 36
                    ];
                }
            }
        }

        foreach ($kelas as $item) {
            Kelas::create($item);
        }
    }
}