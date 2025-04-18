<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    use HasFactory;
    protected $table = 'genre';
    protected $fillable = ['name', 'description'];

    public function books()
    {
        return $this->hasMany(Books::class, 'genre_id');
    }
}
