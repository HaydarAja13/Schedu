<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokProdi extends Model
{
    protected $table = 'kelompok_prodi';
    protected $fillable = [
        'id_kelompok_prodi',
        'nama_kelompok_prodi',
    ];
<<<<<<< HEAD
=======

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%' . $value . '%')->orWhere('nama_kelompok_prodi', 'like', '%' . $value . '%');
    }
>>>>>>> 11d4c02c44be8ec803fe5ac2baf430ac6b6fd911
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_kelompok_prodi');
    }
    public function ruang()
    {
        return $this->hasMany(Ruang::class, 'id_kelompok_prodi');
    }
}
