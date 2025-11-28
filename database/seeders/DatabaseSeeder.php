<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'nama_lengkap' => 'Administrator',
            'level' => 'admin',
            'can_verify' => true,
            'is_active' => true,
        ]);

        User::create([
            'username' => 'kesiswaan',
            'password' => bcrypt('kesiswaan123'),
            'nama_lengkap' => 'Staff Kesiswaan',
            'level' => 'kesiswaan',
            'can_verify' => true,
            'is_active' => true,
        ]);

        User::create([
            'username' => 'guru',
            'password' => bcrypt('guru123'),
            'nama_lengkap' => 'Guru',
            'level' => 'guru',
            'can_verify' => false,
            'is_active' => true,
        ]);

        User::create([
            'username' => 'kepsek',
            'password' => bcrypt('kepsek123'),
            'nama_lengkap' => 'Kepala Sekolah',
            'level' => 'kepsek',
            'can_verify' => true,
            'is_active' => true,
        ]);

        User::create([
            'username' => 'bk',
            'password' => bcrypt('bk123'),
            'nama_lengkap' => 'Bimbingan Konseling',
            'level' => 'bk',
            'can_verify' => true,
            'is_active' => true,
        ]);

       
        User::create([
            'username' => 'siswa1',
            'password' => bcrypt('siswa123'),
            'nama_lengkap' => 'Ahmad Pratama',
            'level' => 'siswa',
            'can_verify' => false,
            'is_active' => true,
        ]);
        
        User::create([
            'username' => 'siswa2',
            'password' => bcrypt('siswa123'),
            'nama_lengkap' => 'Siti Dewi',
            'level' => 'siswa',
            'can_verify' => false,
            'is_active' => true,
        ]);
        
        User::create([
            'username' => 'siswa3',
            'password' => bcrypt('siswa123'),
            'nama_lengkap' => 'Budi Santoso',
            'level' => 'siswa',
            'can_verify' => false,
            'is_active' => true,
        ]);

        $ortuUser = User::create([
            'username' => 'ortu',
            'password' => bcrypt('ortu123'),
            'nama_lengkap' => 'Bapak Ahmad Pratama',
            'level' => 'ortu',
            'can_verify' => false,
            'is_active' => true,
        ]);
        
        // Buat data orangtua di tabel orangtua
        $siswa1User = User::where('username', 'siswa1')->first();
        if ($siswa1User) {
            $siswa1 = \App\Models\Siswa\Siswa::where('nama_lengkap', $siswa1User->nama_lengkap)->first();
            if ($siswa1) {
                \App\Models\Ortu\Orangtua::create([
                    'user_id' => $ortuUser->user_id,
                    'siswa_id' => $siswa1->siswa_id,
                    'hubungan' => 'ayah',
                    'nama_orangtua' => 'Bapak Ahmad Pratama',
                    'pekerjaan' => 'Wiraswasta',
                    'pendidikan' => 'S1',
                    'no_telp' => '081234567890',
                    'alamat' => 'Jl. Merdeka No. 123, Jakarta Selatan'
                ]);
            }
        }

        User::create([
            'username' => 'walikelas',
            'password' => bcrypt('walikelas123'),
            'nama_lengkap' => 'Wali Kelas',
            'level' => 'wali_kelas',
            'can_verify' => false,
            'is_active' => true,
        ]);

        $this->call([
            TahunAjaranSeeder::class,
            GuruSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            JenisPelanggaranSeeder::class,
            JenisPrestasiSeeder::class,
            JenisSanksiSeeder::class,
            PoinSiswaSeeder::class,
            PelanggaranSeeder::class,
            PelanggaranTambahanSeeder::class,
            PrestasiSeeder::class,
            SanksiSeeder::class,
            SiswaDataSeeder::class,
            WaliKelasSeeder::class,
        ]);
    }
}
