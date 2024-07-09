<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRole extends Model
{
    use HasFactory;
    protected $table = 'sub_roles';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_sub_role', 'sub_role_id', 'user_id');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'user_sub_role');
    }
}
