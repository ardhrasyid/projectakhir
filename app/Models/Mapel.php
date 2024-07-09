<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = [
        'nama_mapel',
        'user_id'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relasi ke model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_mapel');
    }
}
