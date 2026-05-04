<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class AhliBotani extends Model
{
   protected $table = 'ahli_botani';

    protected $fillable = [
        'user_id',
        'nama_ahli',
        'no_telp_ahli',
        'tempat_lahir_ahli',
        'tanggal_lahir_ahli',
        'jenis_kelamin_ahli',
        'domisili',
        'nama_almamater',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
