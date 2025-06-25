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
        'no_hp',
        'foto_profil'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value)
    {
        return $query->where('nama_dosen', 'like', '%' . $value . '%')->orWhere('nip', 'like', '%' . $value . '%')->orWhere('email', 'like', '%' . $value . '%');
    }
    public function enrollmentAll()
    {
        return $this->hasMany(EnrollmentMkMhsDsnRng::class, 'id_dosen');
    }

    // Relasi ke mata kuliah yang diampu dosen
    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'enrollment_mk_mhs_dsn_rng', // nama tabel pivot
            'id_dosen',                  // foreign key di tabel pivot untuk dosen
            'id_mata_kuliah'             // foreign key di tabel pivot untuk mata kuliah
        )->distinct();
    }

    // Relasi ke kelas yang diampu dosen
    public function kelas()
    {
        return $this->belongsToMany(
            Kelas::class,
            'enrollment_mk_mhs_dsn_rng', // nama tabel pivot
            'id_dosen',                  // foreign key di tabel pivot untuk dosen
            'id_enrollment_kelas'                   // foreign key di tabel pivot untuk kelas
        )->distinct();
    }

    // Relasi ke jadwal mengajar dosen
    public function jadwal()
    {
        // Jika satu dosen punya banyak jadwal
        return $this->hasMany(Jadwal::class, 'dosen_id', 'id');
    }

    // (Opsional) Relasi ke mahasiswa yang diampu dosen, jika ada
    public function mahasiswa()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'enrollment_mk_mhs_dsn_rng', // nama tabel pivot
            'id_dosen',                  // foreign key di tabel pivot untuk dosen
            'id_mahasiswa'               // foreign key di tabel pivot untuk mahasiswa
        )->distinct();
    }
}
