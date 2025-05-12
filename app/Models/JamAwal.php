<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamAwal extends Model
{
    protected $table = 'jam_awal';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_jam',
        'keterangan',
    ];
}
