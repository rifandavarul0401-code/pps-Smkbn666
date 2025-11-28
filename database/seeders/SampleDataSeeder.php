<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Sanksi\Sanksi;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Pelanggaran
        Pelanggaran::create([
            'siswa_id' => 1,
            'guru_pencatat' => 1,
            'jenis_pelanggaran_id' => 1,
            'tahun_ajaran_id' => 1,
            'poin' => 10,
            'keterangan' => 'Membuat keributan di kelas',
            'status_verifikasi' => 'pending',
            'tanggal' => Carbon::now()->subDays(2),
        ]);

        Pelanggaran::create([
            'siswa_id' => 2,
            'guru_pencatat' => 1,
            'jenis_pelanggaran_id' => 2,
            'tahun_ajaran_id' => 1,
            'poin' => 20,
            'keterangan' => 'Keluar masuk tidak melalui gerbang',
            'status_verifikasi' => 'verified',
            'tanggal' => Carbon::now()->subDays(1),
        ]);

        // Sample Prestasi
        Prestasi::create([
            'siswa_id' => 1,
            'guru_pencatat' => 1,
            'jenis_prestasi_id' => 1,
            'tahun_ajaran_id' => 1,
            'poin' => 50,
            'keterangan' => 'Juara 1 Olimpiade Matematika',
            'status_verifikasi' => 'verified',
        ]);

        Prestasi::create([
            'siswa_id' => 3,
            'guru_pencatat' => 1,
            'jenis_prestasi_id' => 2,
            'tahun_ajaran_id' => 1,
            'poin' => 40,
            'keterangan' => 'Juara 2 Olimpiade Matematika',
            'status_verifikasi' => 'pending',
        ]);

        // Sample Sanksi
        Sanksi::create([
            'pelanggaran_id' => 2,
            'jenis_sanksi' => 'Teguran Tertulis',
            'deskripsi_sanksi' => 'Teguran tertulis karena keluar masuk tidak melalui gerbang',
            'tanggal_mulai' => Carbon::now(),
            'tanggal_selesai' => Carbon::now()->addDays(7),
            'status' => 'aktif',
        ]);
    }
}