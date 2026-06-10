<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkArtikel extends Model
{
    protected $table = 'bookmark_artikel';

    protected $fillable = [
        'user_id',
        'artikel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }
}