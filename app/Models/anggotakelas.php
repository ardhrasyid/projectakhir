<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggotakelas extends Model
{
    use HasFactory;
    protected $table = 'anggota_kelas';
    protected $primaryKey = 'id_anggota';
    protected $fillable = ['kelas_id', 'user_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
