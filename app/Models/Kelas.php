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
    public function enrollmentKelas()
    {
        return $this->hasMany(TahunAkademik::class, 'id_kelas');
    }
}
