<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $namaLaki = ['Ahmad', 'Budi', 'Eko', 'Fajar', 'Gilang', 'Hadi', 'Indra', 'Joko', 'Krisna', 'Lukman', 'Maulana', 'Nanda', 'Oscar', 'Putra', 'Qori', 'Rizki', 'Satria', 'Taufik', 'Umar', 'Vino', 'Wahyu', 'Yoga', 'Zaki', 'Arif', 'Bayu', 'Candra', 'Doni', 'Edi', 'Feri', 'Galih'];
        $namaPerempuan = ['Siti', 'Dewi', 'Aisyah', 'Bella', 'Citra', 'Dina', 'Elsa', 'Fitri', 'Gita', 'Hana', 'Indah', 'Jasmine', 'Kirana', 'Lestari', 'Maya', 'Nisa', 'Olivia', 'Putri', 'Qonita', 'Rina', 'Sarah', 'Tari', 'Ulfa', 'Vina', 'Wulan', 'Yuni', 'Zahra', 'Anisa', 'Bunga', 'Cantika'];
        $namaBelakang = ['Pratama', 'Santoso', 'Wijaya', 'Sari', 'Lestari', 'Putra', 'Putri', 'Rahayu', 'Kusuma', 'Wati', 'Handoko', 'Setiawan', 'Maharani', 'Permana', 'Safitri', 'Nugroho', 'Anggraini', 'Saputra', 'Saputri', 'Hidayat', 'Kurniawan', 'Purnama', 'Susanti', 'Hakim', 'Fitriani', 'Ramadhan', 'Oktaviani', 'Suryani', 'Maulana', 'Andriani'];
        
        // Create specific siswa data first
        $siswaData = [
            [
                'nis' => '2024001',
                'username' => 'siswa1',
                'nisn' => '1234567890',
                'nama_siswa' => 'Ahmad Pratama',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2008-01-15',
                'tempat_lahir' => 'Jakarta',
                'alamat' => 'Jl. Merdeka No. 123',
                'no_telp' => '081234567890',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => '2024002',
                'username' => 'siswa2',
                'nisn' => '1234567891',
                'nama_siswa' => 'Siti Dewi',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2008-02-20',
                'tempat_lahir' => 'Bandung',
                'alamat' => 'Jl. Sudirman No. 456',
                'no_telp' => '081234567891',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => '2024003',
                'username' => 'siswa3',
                'nisn' => '1234567892',
                'nama_siswa' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2008-03-10',
                'tempat_lahir' => 'Surabaya',
                'alamat' => 'Jl. Gatot Subroto No. 789',
                'no_telp' => '081234567892',
                'kelas_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        // Add more random siswa
        for ($i = 4; $i <= 50; $i++) {
            $jenisKelamin = rand(0, 1) ? 'L' : 'P';
            $namaDepan = $jenisKelamin == 'L' ? $namaLaki[array_rand($namaLaki)] : $namaPerempuan[array_rand($namaPerempuan)];
            $namaBelakangRandom = $namaBelakang[array_rand($namaBelakang)];
            
            $siswaData[] = [
                'nis' => str_pad(2024000 + $i, 7, '0', STR_PAD_LEFT),
                'username' => 'siswa' . $i,
                'nisn' => '123456789' . str_pad($i, 1, '0', STR_PAD_LEFT),
                'nama_siswa' => $namaDepan . ' ' . $namaBelakangRandom,
                'jenis_kelamin' => $jenisKelamin,
                'tanggal_lahir' => '2008-' . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'tempat_lahir' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang'][array_rand(['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang'])],
                'alamat' => 'Jl. ' . ['Merdeka', 'Sudirman', 'Thamrin', 'Gatot Subroto', 'Ahmad Yani'][array_rand(['Merdeka', 'Sudirman', 'Thamrin', 'Gatot Subroto', 'Ahmad Yani'])] . ' No. ' . rand(1, 999),
                'no_telp' => '0812345678' . str_pad(rand(10, 99), 2, '0', STR_PAD_LEFT),
                'kelas_id' => rand(1, 12),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('siswa')->insert($siswaData);
    }
}