<?php

namespace App\Models\Pelanggaran;

use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    protected $table = 'jenis_pelanggaran';
    protected $primaryKey = 'jenis_pelanggaran_id';
    
    protected $fillable = [
        'kode_pelanggaran',
        'nama_pelanggaran',
        'deskripsi',
        'poin',
        'kategori',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}