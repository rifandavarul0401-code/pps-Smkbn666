<?php

namespace App\Models\Siswa;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa\Siswa;

class PoinSiswa extends Model
{
    protected $table = 'poin_siswa';
    
    protected $fillable = [
        'siswa_id',
        'total_poin',
        'poin_pelanggaran',
        'poin_prestasi'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function updateTotalPoin()
    {
        $this->total_poin = 100 - $this->poin_pelanggaran + $this->poin_prestasi;
        $this->save();
    }
}