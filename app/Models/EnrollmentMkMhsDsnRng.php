<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentMkMhsDsnRng extends Model
{
    protected $table = 'enrollment_mk_mhs_dsn_rng';

    protected $fillable = [
        'id_mata_kuliah',
        'id_enrollment_kelas',
        'id_dosen',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah');
    }
    public function enrollmentKelas()
    {
        return $this->belongsTo(EnrollmentKelas::class, 'id_enrollment_kelas');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_enrollment_mk_mhs_dsn_rng');
    }

    public function kelas()
    {
        return $this->belongsTo(EnrollmentKelas::class, 'id_enrollment_kelas');
    }

    

}
