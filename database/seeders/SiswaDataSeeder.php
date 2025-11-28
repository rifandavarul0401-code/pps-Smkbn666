<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaDataSeeder extends Seeder
{
    public function run(): void
    {
        // Add specific pelanggaran for siswa1, siswa2, siswa3
        $pelanggaranData = [
            [
                'siswa_id' => 1, // Ahmad Pratama (siswa1)
                'jenis_pelanggaran_id' => 1,
                'tanggal' => '2024-11-15',
                'poin' => 10,
                'keterangan' => 'Terlambat masuk kelas',
                'status_verifikasi' => 'verified',
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2, // Siti Dewi (siswa2)
                'jenis_pelanggaran_id' => 2,
                'tanggal' => '2024-11-16',
                'poin' => 15,
                'keterangan' => 'Tidak mengerjakan tugas',
                'status_verifikasi' => 'verified',
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pelanggaran')->insert($pelanggaranData);

        // Add specific prestasi for siswa1, siswa3
        $prestasiData = [
            [
                'siswa_id' => 1, // Ahmad Pratama (siswa1)
                'jenis_prestasi_id' => 1,
                'poin' => 20,
                'keterangan' => 'Juara 1 Olimpiade Matematika',
                'status_verifikasi' => 'verified',
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 3, // Budi Santoso (siswa3)
                'jenis_prestasi_id' => 2,
                'poin' => 15,
                'keterangan' => 'Juara 2 Lomba Pidato',
                'status_verifikasi' => 'verified',
                'guru_pencatat' => 1,
                'tahun_ajaran_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('prestasi')->insert($prestasiData);

        // Add sanksi for siswa2
        $sanksiData = [
            [
                'pelanggaran_id' => 2, // Pelanggaran siswa2
                'jenis_sanksi' => 'Teguran Lisan',
                'deskripsi_sanksi' => 'Diberikan teguran lisan karena tidak mengerjakan tugas',
                'tanggal_mulai' => '2024-11-17',
                'tanggal_selesai' => '2024-11-17',
                'status' => 'selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('sanksi')->insert($sanksiData);
    }
}