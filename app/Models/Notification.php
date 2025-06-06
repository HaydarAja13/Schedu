<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'requirement_dosen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_dosen',
        'jam_mulai',
        'jam_selesai',
        'hari',
        'keterangan',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function jamMulai()
    {
        return $this->belongsTo(JamAwal::class, 'jam_mulai');
    }
    public function jamSelesai()
    {
        return $this->belongsTo(JamAkhir::class, 'jam_selesai');
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id_dosen', 'like', '%' . $value . '%')->orWhere('jam_mulai', 'like', '%' . $value . '%')->orWhere('jam_selesai', 'like', '%' . $value . '%')->orWhere('hari', 'like', '%' . $value . '%')->orWhere('keterangan', 'like', '%' . $value . '%')->orWhere('status', 'like', '%' . $value . '%');
    }
}
