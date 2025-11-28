<?php

namespace App\Models\Sanksi;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanSanksi extends Model
{
    protected $table = 'pelaksanaan_sanksi';
    protected $primaryKey = 'pelaksanaan_id';
    
    protected $fillable = [
        'sanksi_id',
        'tanggal_pelaksanaan',
        'deskripsi_pelaksanaan',
        'bukti_pelaksanaan',
        'status',
        'guru_pengawas'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];

    public function sanksi()
    {
        return $this->belongsTo(Sanksi::class, 'sanksi_id', 'sanksi_id');
    }
}