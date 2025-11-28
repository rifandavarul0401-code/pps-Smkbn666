<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa\Siswa;
use App\Models\Ortu\Orangtua;

class OrtuSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user ortu
        $ortuUser = User::where('username', 'ortu')->first();
        
        if (!$ortuUser) {
            echo "User ortu tidak ditemukan\n";
            return;
        }
        
        // Ambil siswa pertama yang ada
        $siswa = Siswa::first();
        
        if (!$siswa) {
            echo "Siswa tidak ditemukan\n";
            return;
        }
        
        // Buat atau update data orangtua
        Orangtua::updateOrCreate(
            ['user_id' => $ortuUser->user_id],
            [
                'siswa_id' => $siswa->siswa_id,
                'hubungan' => 'ayah',
                'nama_orangtua' => 'Bapak Surya Pratama',
                'pekerjaan' => 'Wiraswasta',
                'pendidikan' => 'S1',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Selatan'
            ]
        );
        
        echo "Data orangtua berhasil dibuat untuk siswa: " . $siswa->nama_lengkap . "\n";
    }
}