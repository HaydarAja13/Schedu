<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'email',
        'password',
        'no_hp'
    ];
    
    public function enrollmentMahasiswaKelas()
    {
        return $this->hasMany(EnrollmentMahasiswaKelas::class, 'id_mahasiswa');
    }
}
