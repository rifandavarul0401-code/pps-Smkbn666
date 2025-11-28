<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggaran\Pelanggaran;
use App\Models\Prestasi\Prestasi;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'guru_id';
    
    protected $fillable = [
        'user_id',
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'bidang_studi',
        'email',
        'no_telp',
        'status'
    ];

    protected $casts = [
        'jenis_kelamin' => 'string',
        'status' => 'string',
    ];

    public function getNamaLengkapAttribute()
    {
        return $this->nama_guru;
    }

    public function pelanggaranDicatat()
    {
        return $this->hasMany(Pelanggaran::class, 'guru_pencatat', 'guru_id');
    }

    public function prestasiDicatat()
    {
        return $this->hasMany(Prestasi::class, 'guru_pencatat', 'guru_id');
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
