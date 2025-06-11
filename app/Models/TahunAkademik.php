<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = 'tahun_akademik';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahun_ajaran',
        'status',
    ];

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%' . $value . '%')->orWhere('tahun_ajaran', 'like', '%' . $value . '%')->orWhere('status', 'like', '%' . $value . '%')->orWhere('jenis', 'like', '%' . $value . '%')->orWhere('ruang_prioritas', 'like', '%' . $value . '%');
    }
}
