<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileController extends Controller
{
    use HasFactory;
    protected $fillable = ['age', 'address', 'user_id'];
}
