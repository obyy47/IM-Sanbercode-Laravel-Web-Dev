<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GenreController;

Route::get('/', [DashboardController::class, 'home']);
Route::get('/daftar', [FormController::class, 'pendaftaran']);
Route::post('/welcome', [FormController::class, 'welcome']);

// CRUD genre

// Create Data = C
Route::get('/genre/create', [GenreController::class, 'create']);
Route::post('/genre', [GenreController::class, 'store']);

// Read Data = R
Route::get('/genre', [GenreController::class, 'index']);
Route::get('/genre/{id}', [GenreController::class, 'show']);

// Update Data = U
Route::get('/genre/{id}/edit', [GenreController::class, 'edit']);
Route::put('/genre/{id}', [GenreController::class, 'update']);

// Delete Data = D
Route::delete('/genre/{id}', [GenreController::class, 'destroy']);