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

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%' . $value . '%')->orWhere('nama_kelompok_prodi', 'like', '%' . $value . '%');
    }
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_kelompok_prodi');
    }
    public function ruang()
    {
        return $this->hasMany(Ruang::class, 'id_kelompok_prodi');
    }
}
