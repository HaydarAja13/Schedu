<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Dosen extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table = 'dosen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama_dosen',
        'email',
        'password',
        'no_hp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function enrollmentAll()
    {
        return $this->hasMany(EnrollmentMkMhsDsnRng::class, 'id_dosen');
    }
}
