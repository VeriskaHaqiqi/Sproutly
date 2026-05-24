<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'user_id',
        'ahli_botani_id',
        'pembayaran_id',
        'tarif_ahli_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_konsultasi',
        'topik',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class);
    }
}