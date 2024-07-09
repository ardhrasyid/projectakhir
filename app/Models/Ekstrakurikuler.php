<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'user_id', 'deskripsi', 'status', 'kuota', 'status_pendaftaran', 'tgl_dibuka', 'tgl_ditutup'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(PendaftaranEkstra::class, 'id_ekskul');
    }

    public function siswaSudahApply($userId)
    {
        return $this->pendaftarans()->where('id_user', $userId)->exists();
    }

    public function updateStatusPendaftaran()
    {
        $jumlahPendaftar = $this->pendaftarans()->count();
        if ($jumlahPendaftar >= $this->kuota) {
            $this->status_pendaftaran = '1';
        } else {
            $this->status_pendaftaran = '0';
        }
        $this->save();
    }

    public function pendaftaranEkstra()
    {
        return $this->hasMany(PendaftaranEkstra::class, 'id_ekstra');
    }
}

