<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sanksi\Sanksi;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Sanksi\JenisSanksi;

class SanksiSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggaran = Pelanggaran::where('status_verifikasi', 'verified')->get();
        $jenisSanksi = JenisSanksi::all();

        if ($pelanggaran->count() > 0 && $jenisSanksi->count() > 0) {
            foreach ($pelanggaran as $index => $p) {
                // Skip if sanksi already exists for this pelanggaran
                if (Sanksi::where('pelanggaran_id', $p->pelanggaran_id)->exists()) {
                    continue;
                }

                $jenis = $jenisSanksi->get($index % $jenisSanksi->count());
                
                Sanksi::create([
                    'pelanggaran_id' => $p->pelanggaran_id,
                    'jenis_sanksi' => $jenis->nama_sanksi,
                    'deskripsi_sanksi' => 'Sanksi untuk pelanggaran: ' . $p->keterangan,
                    'tanggal_mulai' => now()->addDays($index),
                    'tanggal_selesai' => now()->addDays($index + 7),
                    'status' => $index % 3 == 0 ? 'selesai' : ($index % 2 == 0 ? 'aktif' : 'aktif')
                ]);
            }
        }
    }
}