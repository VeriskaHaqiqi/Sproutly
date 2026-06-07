<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';
    protected $primaryKey = 'id_rating';
    
    protected $fillable = [
        'id_user',
        'id_ahli',
        'id_konsultasi',
        'bintang',
        'ulasan'
    ];

    protected $casts = [
        'bintang' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke user (pemberi rating)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke ahli botani (yang dirating)
    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class, 'id_ahli', 'id');
    }

    // Relasi ke konsultasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class, 'id_konsultasi', 'id_konsultasi');
    }
}