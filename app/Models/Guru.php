<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'id',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_telp',
        'user_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_guru');
    }
}

