<?php

namespace App\Models\Kesiswaan;

use Illuminate\Database\Eloquent\Model;

class Kesiswaan extends Model
{
    protected $table = 'kesiswaan';
    protected $primaryKey = 'kesiswaan_id';
    
    protected $fillable = [
        'user_id',
        'nip',
        'nama_lengkap',
        'email',
        'no_telepon',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'is_active'
    ];
}
