<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SubRole;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function subRoles()
    {
        return $this->belongsToMany(SubRole::class, 'user_sub_role');
    }


    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

public function kelas()
{
    return $this->hasOne(Kelas::class, 'user_id');
}
public function mapel()
{
    return $this->hasOne(Mapel::class, 'user_id');
}

public function ekstrakurikuler()
{
    return $this->hasMany(Ekstrakurikuler::class, 'user_id');
}

public function pendaftaranEkstra()
{
    return $this->hasMany(PendaftaranEkstra::class, 'user_id');
}

public function anggotaKelas()
{
    return $this->hasMany(AnggotaKelas::class, 'user_id');
}

public function prestasi()
{
    return $this->hasMany(Prestasi::class, 'user_id');
}


}

