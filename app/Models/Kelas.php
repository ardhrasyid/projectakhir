<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas','user_id'];


    // Relasi ke model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model AnggotaKelas
    public function anggotaKelas()
    {
        return $this->hasMany(AnggotaKelas::class, 'id_kelas');
    }

    public function filterUserIdByKelas($id_kelas)
    {
        return $this->anggotaKelas()->where('kelas_id', $id_kelas)->pluck('user_id');
    }
}
