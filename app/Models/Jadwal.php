<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'id_enrollment_mk_mhs_dsn_rng',
        'hari',
        'id_jam_awal',
        'id_jam_akhir',
        'id_ruang',
    ];

    public function enrollmentMkMhsDsnRng()
    {
        return $this->belongsTo(EnrollmentMkMhsDsnRng::class, 'id_enrollment_mk_mhs_dsn_rng');
    }
    public function jamAwal()
    {
        return $this->belongsTo(JamAwal::class, 'id_jam_awal');
    }
    public function jamAkhir()
    {
        return $this->belongsTo(JamAkhir::class, 'id_jam_akhir');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }
}
