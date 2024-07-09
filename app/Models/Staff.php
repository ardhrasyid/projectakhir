<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = [
        'id',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_telp',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subRoles()
    {
        return $this->belongsToMany(SubRole::class, 'user_sub_role', 'user_id', 'sub_role_id');
    }
}
