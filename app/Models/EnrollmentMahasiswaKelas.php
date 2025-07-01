<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentMahasiswaKelas extends Model
{
    protected $table = 'enrollment_mahasiswa_kelas';
    protected $fillable = ['id_mahasiswa', 'id_enrollment_kelas'];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function enrollmentKelas()
    {
        return $this->belongsTo(EnrollmentKelas::class, 'id_enrollment_kelas');
    }
    public function enrollmentMkMhsDsnRng()
    {
        return $this->hasMany(EnrollmentMkMhsDsnRng::class, 'id_enrollment_kelas', 'id_enrollment_kelas'); // Sesuaikan kolom kunci asing
    }

}
