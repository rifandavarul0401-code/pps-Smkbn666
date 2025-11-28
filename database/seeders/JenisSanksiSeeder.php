<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sanksi\JenisSanksi;

class JenisSanksiSeeder extends Seeder
{
    public function run(): void
    {
        $jenisSanksi = [
            [
                'nama_sanksi' => 'Teguran Lisan',
                'deskripsi' => 'Teguran secara lisan kepada siswa',
                'is_active' => true
            ],
            [
                'nama_sanksi' => 'Teguran Tertulis',
                'deskripsi' => 'Teguran secara tertulis kepada siswa',
                'is_active' => true
            ],
            [
                'nama_sanksi' => 'Skorsing',
                'deskripsi' => 'Siswa tidak diperbolehkan masuk sekolah untuk sementara waktu',
                'is_active' => true
            ],
            [
                'nama_sanksi' => 'Pembinaan',
                'deskripsi' => 'Pembinaan khusus untuk siswa',
                'is_active' => true
            ],
            [
                'nama_sanksi' => 'Kerja Sosial',
                'deskripsi' => 'Siswa melakukan kerja sosial sebagai sanksi',
                'is_active' => true
            ],
            [
                'nama_sanksi' => 'Panggilan Orang Tua',
                'deskripsi' => 'Memanggil orang tua siswa untuk konsultasi',
                'is_active' => true
            ]
        ];

        foreach ($jenisSanksi as $sanksi) {
            JenisSanksi::create($sanksi);
        }
    }
}