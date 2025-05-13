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
}
