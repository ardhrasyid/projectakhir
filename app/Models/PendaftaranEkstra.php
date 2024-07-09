<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranEkstra extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_ekstra';
    protected $primaryKey = 'id';
    protected $fillable = ['id_ekskul', 'id_user', 'tanggal_daftar', 'status_penerimaan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ekstra()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekskul');
    }
}
