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
        'no_hp',
        'foto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value){
        return $query->where('nama_mahasiswa', 'like', '%' . $value . '%')->orWhere('nim', 'like', '%'. $value. '%')->orWhere('email', 'like', '%'. $value. '%');
    }
    public function enrollmentMahasiswaKelas()
    {
        return $this->hasMany(EnrollmentMahasiswaKelas::class, 'id_mahasiswa');
    }
}
