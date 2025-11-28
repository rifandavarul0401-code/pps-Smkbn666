<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';

    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'kapasitas',
        'wali_kelas_id'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'kelas_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id', 'guru_id');
    }
}