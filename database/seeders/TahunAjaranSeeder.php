<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Core\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        TahunAjaran::create([
            'nama_tahun_ajaran' => '2024/2025',
            'tanggal_mulai' => '2024-07-01',
            'tanggal_selesai' => '2025-06-30',
            'is_active' => true,
        ]);

        TahunAjaran::create([
            'nama_tahun_ajaran' => '2023/2024',
            'tanggal_mulai' => '2023-07-01',
            'tanggal_selesai' => '2024-06-30',
            'is_active' => false,
        ]);
    }
}