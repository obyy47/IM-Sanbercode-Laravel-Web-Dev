<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'summary', 'image', 'stock', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo(genre::class, 'genre_id');
    }
}
