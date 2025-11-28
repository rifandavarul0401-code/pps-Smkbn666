<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_pelanggaran')->insert([
            [
                'nama_kategori' => 'Pelanggaran Ringan',
                'deskripsi' => 'Pelanggaran dengan tingkat kesalahan ringan',
                'warna' => '#28a745',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pelanggaran Sedang',
                'deskripsi' => 'Pelanggaran dengan tingkat kesalahan sedang',
                'warna' => '#ffc107',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pelanggaran Berat',
                'deskripsi' => 'Pelanggaran dengan tingkat kesalahan berat',
                'warna' => '#dc3545',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
