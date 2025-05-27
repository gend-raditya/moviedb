<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

//route untuk menyimpan data
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movies/{slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/{slug}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('/movies/{slug}', [MovieController::class, 'destroy'])->name('movies.destroy');

// routes/web.php
Route::get('/test', function () {
    return view('test');
});







