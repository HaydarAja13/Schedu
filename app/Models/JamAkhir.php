<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamAkhir extends Model
{
    protected $table = 'jam_akhir';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_jam',
        'keterangan',
    ];
}
