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

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'konsultasi_id')->orderBy('waktu_kirim', 'asc');
    }

    public function tarifAhli()
    {
        return $this->belongsTo(TarifAhli::class, 'tarif_ahli_id');
    }

    // TAMBAHKAN METHOD INI UNTUK RATING
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}