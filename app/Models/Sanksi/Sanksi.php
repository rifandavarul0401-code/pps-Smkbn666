<?php

namespace App\Models\Sanksi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggaran\Pelanggaran;

class Sanksi extends Model
{
    protected $table = 'sanksi';
    protected $primaryKey = 'sanksi_id';
    
    protected $fillable = [
        'pelanggaran_id',
        'jenis_sanksi',
        'deskripsi_sanksi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id', 'pelanggaran_id');
    }
    
    public function siswa()
    {
        return $this->hasOneThrough(
            \App\Models\Siswa\Siswa::class,
            Pelanggaran::class,
            'pelanggaran_id', // Foreign key on pelanggaran table
            'siswa_id', // Foreign key on siswa table
            'pelanggaran_id', // Local key on sanksi table
            'siswa_id' // Local key on pelanggaran table
        );
    }

    public function pelaksanaanSanksi()
    {
        return $this->hasMany(PelaksanaanSanksi::class, 'sanksi_id', 'sanksi_id');
    }
    
    public function jenisSanksi()
    {
        return $this->belongsTo(JenisSanksi::class, 'jenis_sanksi_id', 'jenis_sanksi_id');
    }
}