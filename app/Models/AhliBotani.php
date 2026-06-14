<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliBotani extends Model
{
    use HasFactory;

    protected $table = 'ahli_botani';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'nama_ahli',
        'no_telp_ahli',
        'tempat_lahir_ahli',
        'tanggal_lahir_ahli',
        'jenis_kelamin_ahli',
        'domisili',
        'nama_almamater',
        'spesialisasi',
        'bio',
        'pengalaman_tahun'
    ];

    protected $casts = [
        'tanggal_lahir_ahli' => 'date'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke rating (yang menerima rating)
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'ahli_botani_id', 'id');
    }
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'ahli_botani_id', 'id');
    }

    public function jadwalAhli()
    {
        return $this->hasMany(JadwalAhli::class, 'ahli_botani_id', 'id');
    }

    public function tarif()
    {
        return $this->hasMany(TarifAhli::class, 'ahli_botani_id', 'id');
    }
}