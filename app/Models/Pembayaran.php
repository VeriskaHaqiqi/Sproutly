<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    
    protected $fillable = [
        'user_id',
        'jumlah',
        'metode',
        'bukti_transfer',
        'tgl_pembayaran',
        'status_pembayaran'
    ];

    protected $casts = [
        'tgl_pembayaran' => 'datetime',
        'jumlah' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relasi ke konsultasi (satu pembayaran untuk satu konsultasi)
     */
    public function konsultasi()
    {
        return $this->hasOne(Konsultasi::class, 'pembayaran_id');
    }
}