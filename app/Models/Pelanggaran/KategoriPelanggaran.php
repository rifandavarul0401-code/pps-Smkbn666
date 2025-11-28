<?php

namespace App\Models\Pelanggaran;

use Illuminate\Database\Eloquent\Model;

class KategoriPelanggaran extends Model
{
    protected $table = 'kategori_pelanggaran';
    protected $primaryKey = 'kategori_id';
    
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'warna',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}