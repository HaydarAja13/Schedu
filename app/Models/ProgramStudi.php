<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $fillable = ['id_jurusan', 'nama_prodi', 'kode_prodi', 'id_kelompok_prodi'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function kelompokProdi()
    {
        return $this->belongsTo(KelompokProdi::class, 'id_kelompok_prodi');
    }
    public function enrollmentKelas()
    {
        return $this->hasMany(EnrollmentKelas::class, 'id_program_studi');
    }
}
