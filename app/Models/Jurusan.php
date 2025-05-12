<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_jurusan');
    }
}
