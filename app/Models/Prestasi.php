<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = ['id','nama_prestasi', 'kategori', 'tingkat', 'tahun','bukti','status','user_id'];


    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
