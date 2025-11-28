<?php

namespace App\Models\Ortu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Siswa\Siswa;

class Orangtua extends Model
{
    use HasFactory;

    protected $table = 'orangtua';
    protected $primaryKey = 'orangtua_id';

    protected $fillable = [
        'user_id',
        'siswa_id',
        'hubungan',
        'nama_orangtua',
        'pekerjaan',
        'pendidikan',
        'no_telp',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }
}