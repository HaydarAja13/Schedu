<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama_dosen',
        'email',
        'password',
        'no_hp'
    ];
}
