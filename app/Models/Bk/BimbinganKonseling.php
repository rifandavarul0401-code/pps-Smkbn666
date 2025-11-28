<?php

namespace App\Models\Bk;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;

class BimbinganKonseling extends Model
{
    protected $table = 'bimbingan_konseling';
    protected $primaryKey = 'bimbingan_id';
    
    protected $fillable = [
        'siswa_id',
        'guru_konselor_id',
        'tahun_ajaran_id',
        'jenis_layanan',
        'topik',
        'keluhan_masalah',
        'tindakan_solusi',
        'status',
        'tanggal_konseling',
        'tanggal_tindak_lanjut',
        'hasil_evaluasi'
    ];

    protected $casts = [
        'tanggal_konseling' => 'date',
        'tanggal_tindak_lanjut' => 'date'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    public function guruKonselor()
    {
        return $this->belongsTo(Guru::class, 'guru_konselor_id', 'guru_id');
    }
}
