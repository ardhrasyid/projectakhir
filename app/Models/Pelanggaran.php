<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pelanggaran', 
        'tanggal', 
        'jenis',
        'sanksi', 
        'keterangan', 
        'user_id',
       
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

