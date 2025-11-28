<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'tahun_ajaran_id';
    
    protected $fillable = [
        'nama_tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean'
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}