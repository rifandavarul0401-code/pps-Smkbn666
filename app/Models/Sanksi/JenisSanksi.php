<?php

namespace App\Models\Sanksi;

use Illuminate\Database\Eloquent\Model;

class JenisSanksi extends Model
{
    protected $table = 'jenis_sanksi';
    protected $primaryKey = 'jenis_sanksi_id';
    
    protected $fillable = [
        'nama_sanksi',
        'deskripsi',
        'kategori',
        'min_poin',
        'max_poin',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sanksi()
    {
        return $this->hasMany(Sanksi::class, 'jenis_sanksi_id', 'jenis_sanksi_id');
    }
}