<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks',
        'jam',
        'semester',
        'id_ruang',
        'jenis'
    ];
    public function enrollments()
    {
        return $this->hasMany(EnrollmentMkMhsDsnRng::class, 'id_mata_kuliah', 'id');
    }
    public function scopeSearch($query, $value)
    {
        return $query->where('kode_matkul', 'like', '%' . $value . '%')->orWhere('nama_matkul', 'like', '%' . $value . '%')->orWhere('semester', 'like', '%' . $value . '%')->orWhere('jenis', 'like', '%' . $value . '%')->orWhere('ruang_prioritas', 'like', '%' . $value . '%');
    }

    public function enrollmentMahasiswaKelas()
    {
        // Relasi ke EnrollmentMahasiswaKelas melalui EnrollmentMkMhsDsnRng
        return $this->hasManyThrough(
            EnrollmentMahasiswaKelas::class, // Model tujuan
            EnrollmentMkMhsDsnRng::class,    // Model perantara
            'id_mata_kuliah', // Foreign key di model perantara (EnrollmentMkMhsDsnRng)
            'id_enrollment_kelas', // Foreign key di model tujuan (EnrollmentMahasiswaKelas)
            'id', // Local key di MataKuliah
            'id_enrollment_kelas' // Local key di EnrollmentMkMhsDsnRng
        );
    }
}
