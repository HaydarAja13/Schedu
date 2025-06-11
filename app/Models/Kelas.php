<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kelas'
    ];

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%' . $value . '%')->orWhere('nama_kelas', 'like', '%' . $value . '%');
    }
    public function enrollmentKelas()
    {
        return $this->hasMany(EnrollmentKelas::class, 'id_kelas');
    }
}
