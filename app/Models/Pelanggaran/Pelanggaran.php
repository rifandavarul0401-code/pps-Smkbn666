<?php

namespace App\Models\Pelanggaran;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa\Siswa;
use App\Models\Siswa\PoinSiswa;
use App\Models\Guru\Guru;
use App\Models\Core\TahunAjaran;
use App\Models\Sanksi\Sanksi;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'pelanggaran_id';
    
    public function getRouteKeyName()
    {
        return 'pelanggaran_id';
    }
    
    protected $fillable = [
        'siswa_id',
        'guru_pencatat',
        'jenis_pelanggaran_id',
        'tahun_ajaran_id',
        'poin',
        'keterangan',
        'bukti_foto',
        'status_verifikasi',
        'guru_verifikator',
        'catatan_verifikasi',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'status_verifikasi' => 'string'
    ];

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'jenis_pelanggaran_id', 'jenis_pelanggaran_id');
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

    public function sanksi()
    {
        return $this->hasMany(Sanksi::class, 'pelanggaran_id', 'pelanggaran_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'guru_pencatat', 'user_id');
    }

    protected static function booted()
    {
        static::created(function ($pelanggaran) {
            $poinSiswa = PoinSiswa::firstOrCreate(['siswa_id' => $pelanggaran->siswa_id]);
            $poinSiswa->poin_pelanggaran += $pelanggaran->poin;
            $poinSiswa->total_poin = 100 - $poinSiswa->poin_pelanggaran + $poinSiswa->poin_prestasi;
            $poinSiswa->save();
        });

        static::deleted(function ($pelanggaran) {
            $poinSiswa = PoinSiswa::where('siswa_id', $pelanggaran->siswa_id)->first();
            if ($poinSiswa) {
                $poinSiswa->poin_pelanggaran -= $pelanggaran->poin;
                $poinSiswa->total_poin = 100 - $poinSiswa->poin_pelanggaran + $poinSiswa->poin_prestasi;
                $poinSiswa->save();
            }
        });
    }
}