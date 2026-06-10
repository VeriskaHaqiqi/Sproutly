<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        'ahli_botani_id',
        'judul',
        'konten',
        'thumbnail',
        'kategori',
        'tanggal_unggah',
    ];

    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class, 'ahli_botani_id');
    }
}