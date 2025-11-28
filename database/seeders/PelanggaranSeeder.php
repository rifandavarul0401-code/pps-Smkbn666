<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Core\TahunAjaran;

class PelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();

        if ($siswa->count() > 0 && $jenisPelanggaran->count() > 0 && $tahunAjaran) {
            $pelanggaranData = [
                [
                    'siswa_id' => $siswa->first()->siswa_id,
                    'jenis_pelanggaran_id' => $jenisPelanggaran->first()->jenis_pelanggaran_id,
                    'tanggal' => '2024-11-15',
                    'keterangan' => 'Terlambat masuk kelas lebih dari 15 menit',
                    'status_verifikasi' => 'pending'
                ],
                [
                    'siswa_id' => $siswa->skip(1)->first()->siswa_id,
                    'jenis_pelanggaran_id' => $jenisPelanggaran->skip(1)->first()->jenis_pelanggaran_id,
                    'tanggal' => '2024-11-16',
                    'keterangan' => 'Tidak mengerjakan tugas yang diberikan guru',
                    'status_verifikasi' => 'verified'
                ],
                [
                    'siswa_id' => $siswa->skip(2)->first()->siswa_id,
                    'jenis_pelanggaran_id' => $jenisPelanggaran->skip(2)->first()->jenis_pelanggaran_id,
                    'tanggal' => '2024-11-17',
                    'keterangan' => 'Membuat keributan di kelas saat pelajaran berlangsung',
                    'status_verifikasi' => 'pending'
                ]
            ];

            foreach ($pelanggaranData as $data) {
                $jenis = JenisPelanggaran::find($data['jenis_pelanggaran_id']);
                
                Pelanggaran::create([
                    'siswa_id' => $data['siswa_id'],
                    'jenis_pelanggaran_id' => $data['jenis_pelanggaran_id'],
                    'tanggal' => $data['tanggal'],
                    'poin' => $jenis->poin,
                    'keterangan' => $data['keterangan'],
                    'status_verifikasi' => $data['status_verifikasi'],
                    'guru_pencatat' => 1,
                    'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id
                ]);
            }
        }
    }
}