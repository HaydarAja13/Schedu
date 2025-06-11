<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];
    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%' . $value . '%')->orWhere('nama_jurusan', 'like', '%' . $value . '%');
    }
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_jurusan');
    }
}
