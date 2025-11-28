<?php

namespace App\Models\Siswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Sanksi\Sanksi;
use App\Models\Core\Kelas;
use App\Models\Siswa\PoinSiswa;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';

    protected $fillable = [
        'nis',
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'no_telp',
        'kelas_id',
        'foto',
        'status'
    ];

    public function getNamaLengkapAttribute()
    {
        return $this->nama_siswa;
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'siswa_id', 'siswa_id');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'siswa_id', 'siswa_id');
    }

    public function sanksi()
    {
        return $this->hasMany(Sanksi::class, 'siswa_id', 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'kelas_id');
    }

    public function poinSiswa()
    {
        return $this->hasOne(PoinSiswa::class, 'siswa_id', 'siswa_id');
    }

    public function getTotalPoinAttribute()
    {
        if ($this->poinSiswa) {
            return 100 - $this->poinSiswa->poin_pelanggaran + $this->poinSiswa->poin_prestasi;
        }
        return 100;
    }
}