<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasi = [
            // AKADEMIK
            ['nama_prestasi' => 'Juara 1 Olimpiade Matematika Tingkat Kota', 'poin' => 50, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 50 poin'],
            ['nama_prestasi' => 'Juara 2 Olimpiade Matematika Tingkat Kota', 'poin' => 40, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 3 Olimpiade Matematika Tingkat Kota', 'poin' => 30, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Olimpiade Sains Tingkat Kota', 'poin' => 50, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 50 poin'],
            ['nama_prestasi' => 'Juara 2 Olimpiade Sains Tingkat Kota', 'poin' => 40, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 3 Olimpiade Sains Tingkat Kota', 'poin' => 30, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Karya Ilmiah Remaja', 'poin' => 40, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 1 Debat Bahasa Inggris', 'poin' => 35, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 35 poin'],
            ['nama_prestasi' => 'Ranking 1 Kelas', 'poin' => 20, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 20 poin'],
            ['nama_prestasi' => 'Ranking 2 Kelas', 'poin' => 15, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 15 poin'],
            ['nama_prestasi' => 'Ranking 3 Kelas', 'poin' => 10, 'kategori' => 'akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 10 poin'],
            
            // OLAHRAGA
            ['nama_prestasi' => 'Juara 1 Sepak Bola Tingkat Kota', 'poin' => 50, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 50 poin'],
            ['nama_prestasi' => 'Juara 2 Sepak Bola Tingkat Kota', 'poin' => 40, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 3 Sepak Bola Tingkat Kota', 'poin' => 30, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Bola Basket Tingkat Kota', 'poin' => 50, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 50 poin'],
            ['nama_prestasi' => 'Juara 1 Bola Voli Tingkat Kota', 'poin' => 50, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 50 poin'],
            ['nama_prestasi' => 'Juara 1 Bulu Tangkis Tingkat Kota', 'poin' => 45, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 45 poin'],
            ['nama_prestasi' => 'Juara 1 Atletik Tingkat Kota', 'poin' => 45, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 45 poin'],
            ['nama_prestasi' => 'Juara 1 Renang Tingkat Kota', 'poin' => 45, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 45 poin'],
            ['nama_prestasi' => 'Juara 1 Pencak Silat Tingkat Kota', 'poin' => 45, 'kategori' => 'olahraga', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 45 poin'],
            
            // SENI
            ['nama_prestasi' => 'Juara 1 Lomba Menyanyi Tingkat Kota', 'poin' => 40, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 2 Lomba Menyanyi Tingkat Kota', 'poin' => 30, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 3 Lomba Menyanyi Tingkat Kota', 'poin' => 20, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 20 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Tari Tingkat Kota', 'poin' => 40, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Melukis Tingkat Kota', 'poin' => 35, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 35 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Musik/Band Tingkat Kota', 'poin' => 40, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 40 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Teater Tingkat Kota', 'poin' => 35, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 35 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Fotografi Tingkat Kota', 'poin' => 30, 'kategori' => 'seni', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            
            // NON AKADEMIK
            ['nama_prestasi' => 'Juara 1 Lomba Pidato Tingkat Kota', 'poin' => 35, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 35 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Puisi Tingkat Kota', 'poin' => 30, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Cerpen Tingkat Kota', 'poin' => 30, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Jurnalistik Tingkat Kota', 'poin' => 30, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Desain Grafis Tingkat Kota', 'poin' => 35, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 35 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Robotika Tingkat Kota', 'poin' => 45, 'kategori' => 'non_akademik', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 45 poin'],
            
            // LAINNYA
            ['nama_prestasi' => 'Ketua OSIS', 'poin' => 25, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 25 poin'],
            ['nama_prestasi' => 'Wakil Ketua OSIS', 'poin' => 20, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 20 poin'],
            ['nama_prestasi' => 'Ketua Kelas', 'poin' => 10, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 10 poin'],
            ['nama_prestasi' => 'Siswa Teladan', 'poin' => 30, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 30 poin'],
            ['nama_prestasi' => 'Kehadiran 100% (1 Semester)', 'poin' => 15, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 15 poin'],
            ['nama_prestasi' => 'Volunteer Kegiatan Sekolah', 'poin' => 10, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 10 poin'],
            ['nama_prestasi' => 'Juara 1 Lomba Kebersihan Kelas', 'poin' => 15, 'kategori' => 'lainnya', 'sanksi_rekomendasi' => 'Pengurangan poin pelanggaran 15 poin'],
        ];

        foreach ($prestasi as $item) {
            DB::table('jenis_prestasi')->insert([
                'nama_prestasi' => $item['nama_prestasi'],
                'poin' => $item['poin'],
                'kategori' => $item['kategori'],
                'sanksi_rekomendasi' => $item['sanksi_rekomendasi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
