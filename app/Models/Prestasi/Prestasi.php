<?php

namespace App\Models\Prestasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa\Siswa;
use App\Models\Siswa\PoinSiswa;
use App\Models\Guru\Guru;
use App\Models\Core\TahunAjaran;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $primaryKey = 'prestasi_id';
    
    protected $fillable = [
        'siswa_id',
        'guru_pencatat',
        'jenis_prestasi_id',
        'tahun_ajaran_id',
        'tanggal_prestasi',
        'poin',
        'keterangan',
        'tingkat',
        'status_verifikasi'
    ];

    protected $dates = [
        'tanggal_prestasi',
        'created_at',
        'updated_at'
    ];

    public function jenisPrestasi()
    {
        return $this->belongsTo(JenisPrestasi::class, 'jenis_prestasi_id', 'jenis_prestasi_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    public function guruPencatat()
    {
        return $this->belongsTo(Guru::class, 'guru_pencatat', 'guru_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'guru_pencatat', 'user_id');
    }

    protected static function booted()
    {
        static::created(function ($prestasi) {
            $poinSiswa = PoinSiswa::firstOrCreate(['siswa_id' => $prestasi->siswa_id]);
            $poinSiswa->poin_prestasi += $prestasi->poin;
            $poinSiswa->total_poin = 100 - $poinSiswa->poin_pelanggaran + $poinSiswa->poin_prestasi;
            $poinSiswa->save();
        });

        static::deleted(function ($prestasi) {
            $poinSiswa = PoinSiswa::where('siswa_id', $prestasi->siswa_id)->first();
            if ($poinSiswa) {
                $poinSiswa->poin_prestasi -= $prestasi->poin;
                $poinSiswa->total_poin = 100 - $poinSiswa->poin_pelanggaran + $poinSiswa->poin_prestasi;
                $poinSiswa->save();
            }
        });
    }
}