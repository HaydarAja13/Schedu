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

    public function scopeSearch($query, $value)
    {
        return $query->where('kode_matkul', 'like', '%' . $value . '%')->orWhere('nama_matkul', 'like', '%' . $value . '%')->orWhere('semester', 'like', '%' . $value . '%')->orWhere('jenis', 'like', '%' . $value . '%')->orWhere('ruang_prioritas', 'like', '%' . $value . '%');
    }
}
