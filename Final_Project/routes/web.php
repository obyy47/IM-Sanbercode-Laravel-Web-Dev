<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BooksController;


Route::get('/', [DashboardController::class, 'index'])->name('homepage'); // Homepage
Route::get('/books/{id}', [DashboardController::class, 'show'])->name('book.show'); // Book detail page
Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'indexlogin'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'roles:admin'])->group(function () {


    //Route::get('/admin', [DashboardController::class, 'index']);
    //Books
    Route::get('/admin/book', [BooksController::class, 'index']);
    Route::get('/admin/book/add', [BooksController::class, 'create']);
    Route::post('/admin/book/add', [BooksController::class, 'store'])->name('books.store');
    Route::put('/admin/genre/update/{id}', [BooksController::class, 'update'])->name('books.update');
    Route::delete('/admin/genre/delete/{id}', [BooksController::class, 'destroy'])->name('books.delete');

    Route::put('/admin/book/update/{id}', [BooksController::class, 'update'])->name('books.update');
    Route::delete('/admin/book/delete/{id}', [BooksController::class, 'destroy'])->name('books.delete');
    //Genre
    Route::get('/admin/genre', [GenreController::class, 'index']);
    Route::post('/admin/genre/add', [GenreController::class, 'store'])->name('genre.store');
    Route::put('/admin/genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/admin/genre/delete/{id}', [GenreController::class, 'destroy'])->name('genre.delete');
});
Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::post('/comment', [DashboardController::class, 'storeComment'])->name('comment.store'); // Comment submission
});
