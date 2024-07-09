<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
protected $table = 'absensi';

protected $primaryKey = 'id_absen';

protected $fillable = [
    'siswa_id',
    'tanggal',
    'status',
];
}
