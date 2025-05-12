<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    protected $table = 'angkatan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahun_angkatan'
    ];
    public function angkatan()
    {
        return $this->hasMany(EnrollmentKelas::class, 'id_angkatan');
    }
}
