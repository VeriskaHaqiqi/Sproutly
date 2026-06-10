<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAhli extends Model
{
    protected $table = 'jadwal_ahli';

    protected $fillable = [
        'ahli_botani_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status_ketersediaan',
    ];

    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class, 'ahli_botani_id');
    }
}