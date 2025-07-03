<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentKelas extends Model
{
    protected $table = 'enrollment_kelas';
    protected $fillable = ['id_tahun_akademik', 'id_program_studi', 'id_kelas', 'id_angkatan'];
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
    public function enrollmentMkMhsDsnRng()
    {
        return $this->hasMany(EnrollmentMkMhsDsnRng::class, 'id_enrollment_kelas');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_studi');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan');
    }

    public function enrollmentMahasiswaKelas()
    {
        return $this->hasMany(EnrollmentMahasiswaKelas::class, 'id_enrollment_kelas');
    }
    
    
}
