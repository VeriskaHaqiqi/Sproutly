<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'konsultasi_id',
        'pengirim',
        'isi_pesan',
        'gambar',
        'waktu_kirim',
    ];

    protected $casts = [
        'waktu_kirim' => 'datetime',
    ];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }
}
