<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'no_telp_user',
        'tempat_lahir_user',
        'tanggal_lahir_user',
        'jenis_kelamin_user',
        'role',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Relasi
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'user_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_user', 'id');
    }
}