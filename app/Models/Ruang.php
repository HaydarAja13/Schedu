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
}
