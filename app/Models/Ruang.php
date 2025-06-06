<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_ruang',
        'keterangan',
    ];
    public function scopeSearch($query, $value)
    {
        return $query->where('id_ruang', 'like', '%' . $value . '%')->orWhere('nama_ruang', 'like', '%' . $value . '%')->orWhere('keterangan', 'like', '%' . $value . '%')->orWhere('jenis', 'like', '%' . $value . '%')->orWhere('ruang_prioritas', 'like', '%' . $value . '%');
    }
}
