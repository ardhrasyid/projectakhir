<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kelas',
        'id_mapel',
        'id_user',
        'hari',
        'pukul',
    ];

    public static function filterByKelas($kelasId)
    {
        return self::query()
            ->when($kelasId, function ($query, $kelasId) {
                return $query->where('id_kelas', $kelasId);
            })
            ->get();
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi ke model Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
