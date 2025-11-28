<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru\Guru;
use App\Models\Core\Kelas;
use Illuminate\Database\Seeder;

class WaliKelasSeeder extends Seeder
{
    public function run(): void
    {
        $waliKelasUser = User::where('username', 'walikelas')->first();
        
        if ($waliKelasUser) {
            $guru = Guru::create([
                'user_id' => $waliKelasUser->user_id,
                'nip' => '198501012010011001',
                'nama_lengkap' => $waliKelasUser->nama_lengkap,
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1985-01-01',
                'alamat' => 'Jl. Pendidikan No. 1',
                'no_telp' => '081234567891',
                'email' => 'walikelas@sekolah.sch.id',
            ]);

            $kelas = Kelas::where('nama_kelas', 'X PPLG 1')->first();
            if ($kelas) {
                $kelas->update(['wali_kelas_id' => $guru->guru_id]);
            }
        }
    }
}
