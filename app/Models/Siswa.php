<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_kelamin', 
        'agama', 
        'alamat', 
        'no_telp', 
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id', 'id_kelas');
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'siswa_id');
    }
}
