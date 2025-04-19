<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsController extends Controller
{
    use HasFactory;
    protected $fillable = ['content', 'user_id', 'book_id'];
}
