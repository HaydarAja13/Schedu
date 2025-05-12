<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama_admin',
        'email',
        'password',
        'no_hp'
    ];
}
