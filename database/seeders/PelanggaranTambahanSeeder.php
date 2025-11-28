<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Siswa\Siswa;
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Core\TahunAjaran;
use Carbon\Carbon;

class PelanggaranTambahanSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();

        if ($siswa->count() > 0 && $jenisPelanggaran->count() > 0 && $tahunAjaran) {
            $pelanggaranData = [
                // Januari (2 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-01-15', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-01-25', 'status' => 'pending'],
                
                // Februari (4 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-02-05', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-02-12', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-02-18', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-02-28', 'status' => 'verified'],
                
                // Maret (3 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-03-08', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-03-15', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-03-22', 'status' => 'verified'],
                
                // April (5 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-04-03', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-04-10', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-04-16', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-04-22', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-04-28', 'status' => 'verified'],
                
                // Mei (2 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-05-07', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-05-20', 'status' => 'pending'],
                
                // Juni (1 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-06-12', 'status' => 'verified'],
                
                // Juli (3 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-07-05', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-07-18', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-07-25', 'status' => 'verified'],
                
                // Agustus (4 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-08-08', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-08-15', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-08-22', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-08-28', 'status' => 'verified'],
                
                // September (2 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-09-10', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-09-25', 'status' => 'pending'],
                
                // Oktober (6 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-03', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-08', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-15', 'status' => 'pending'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-20', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-25', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-10-30', 'status' => 'pending'],
                
                // Desember (2 pelanggaran)
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-12-05', 'status' => 'verified'],
                ['siswa_id' => $siswa->random()->siswa_id, 'jenis_pelanggaran_id' => $jenisPelanggaran->random()->jenis_pelanggaran_id, 'tanggal' => '2024-12-18', 'status' => 'pending'],
            ];

            foreach ($pelanggaranData as $data) {
                $jenis = JenisPelanggaran::find($data['jenis_pelanggaran_id']);
                
                Pelanggaran::create([
                    'siswa_id' => $data['siswa_id'],
                    'jenis_pelanggaran_id' => $data['jenis_pelanggaran_id'],
                    'tanggal' => $data['tanggal'],
                    'poin' => $jenis->poin,
                    'keterangan' => 'Data pelanggaran seeder tambahan',
                    'status_verifikasi' => $data['status'],
                    'guru_pencatat' => 1,
                    'tahun_ajaran_id' => $tahunAjaran->tahun_ajaran_id
                ]);
            }
        }
    }
}