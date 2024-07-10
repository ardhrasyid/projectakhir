<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'anggota_kelas_id',
        'tanggal',
        'status',
    ];
    
    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'anggota_kelas_id');
    }

    // Tambahkan scope untuk filter berdasarkan kelas
    public function scopeFilterByKelas($query, $kelasId)
    {
        if ($kelasId) {
            return $query->whereHas('anggotakelas', function($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            });
        }

        return $query;
    }
}
