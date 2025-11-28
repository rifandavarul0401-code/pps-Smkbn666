<?php

namespace App\Models\Prestasi;

use Illuminate\Database\Eloquent\Model;

class JenisPrestasi extends Model
{
    protected $table = 'jenis_prestasi';
    protected $primaryKey = 'jenis_prestasi_id';
    
    protected $fillable = [
        'nama_prestasi',
        'poin',
        'kategori',
        'deskripsi',
        'reward'
    ];
    
    public $timestamps = ['created_at'];
    const UPDATED_AT = null;

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'jenis_prestasi_id', 'jenis_prestasi_id');
    }
}