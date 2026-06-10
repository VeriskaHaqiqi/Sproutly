<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifAhli extends Model
{
    protected $table = 'tarif_ahli';

    protected $fillable = [
        'ahli_botani_id',
        'tarif',
        'tgl_mulai_berlaku',
        'tgl_akhir_berlaku',
        'status_aktif',
    ];

    public function ahliBotani()
    {
        return $this->belongsTo(AhliBotani::class, 'ahli_botani_id');
    }
}