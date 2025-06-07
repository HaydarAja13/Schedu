<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $fillable = ['id_jurusan', 'nama_prodi', 'kode_prodi'];
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function enrollmentKelas()
    {
        return $this->hasMany(EnrollmentKelas::class, 'id_program_studi ');
    }
    public function scopeSearch($query, $term)
    {
        return $query->where('nama_prodi', 'like', "%$term%")
                    ->orWhere('kode_prodi', 'like', "%$term%")
                    ->orWhere('id_jurusan', 'like', "%$term%");
    }
}