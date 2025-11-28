<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'nip' => '198501012010011001',
                'nama_guru' => 'Drs. Ahmad Fauzi, M.Pd',
                'jenis_kelamin' => 'L',
                'bidang_studi' => 'Matematika',
                'email' => 'ahmad.fauzi@sekolah.sch.id',
                'no_telp' => '081234567890',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198703152011012002',
                'nama_guru' => 'Siti Nurhaliza, S.Pd',
                'jenis_kelamin' => 'P',
                'bidang_studi' => 'Bahasa Indonesia',
                'email' => 'siti.nurhaliza@sekolah.sch.id',
                'no_telp' => '081234567891',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '199002202012011003',
                'nama_guru' => 'Budi Santoso, S.Pd',
                'jenis_kelamin' => 'L',
                'bidang_studi' => 'Bimbingan Konseling',
                'email' => 'budi.santoso@sekolah.sch.id',
                'no_telp' => '081234567892',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '199105102013012004',
                'nama_guru' => 'Dewi Lestari, S.Sn',
                'jenis_kelamin' => 'P',
                'bidang_studi' => 'Desain Grafis',
                'email' => 'dewi.lestari@sekolah.sch.id',
                'no_telp' => '081234567893',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '199208152014011005',
                'nama_guru' => 'Eko Prasetyo, S.Kom',
                'jenis_kelamin' => 'L',
                'bidang_studi' => 'Pemrograman',
                'email' => 'eko.prasetyo@sekolah.sch.id',
                'no_telp' => '081234567894',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
