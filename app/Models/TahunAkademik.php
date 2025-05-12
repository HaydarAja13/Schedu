<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = 'tahun_akademik';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahun_ajaran',
        'status',
    ];

    public function enrollmentKelas()
    {
        return $this->hasMany(EnrollmentKelas::class, 'id_tahun_akademik');
    }
}
