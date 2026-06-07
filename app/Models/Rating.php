<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating'; // ← perhatikan: 'rating' bukan 'ratings'
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',        // ← sesuai migration
        'ahli_botani_id', // ← sesuai migration
        'konsultasi_id',  // ← sesuai migration
        'nilai',          // ← sesuai migration (bukan bintang)
        'ulasan',
        'tanggal'
    ];

    protected $casts = [
        'nilai' => 'integer',
        'tanggal' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke user (pemberi rating)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke ahli botani (yang dirating)
    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class, 'ahli_botani_id', 'id');
    }

    // Relasi ke konsultasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class, 'konsultasi_id', 'id');
    }
}